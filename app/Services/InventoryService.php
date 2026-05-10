<?php

namespace App\Services;

use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Contracts\Repositories\StockMovementRepositoryInterface;
use App\Contracts\Services\InventoryServiceInterface;
use App\Models\InventoryBatch;
use Illuminate\Support\Facades\DB;

class InventoryService implements InventoryServiceInterface
{
    protected $inventoryRepo;
    protected $movementRepo;

    public function __construct(
        InventoryRepositoryInterface $inventoryRepo,
        StockMovementRepositoryInterface $movementRepo
    ) {
        $this->inventoryRepo = $inventoryRepo;
        $this->movementRepo = $movementRepo;
    }

    public function batchProcess(array $operations, $reference)
{
    return DB::transaction(function () use ($operations, $reference) {

        $results = [];

        foreach ($operations as $op) {

            $itemId   = $op['item_id'];
            $quantity = $op['quantity'];
            $type     = $op['type'];
            $operation = $op['operation'];

            $inventory = $this->inventoryRepo->getByItemForUpdate($itemId);

            if (!$inventory) {
                $this->inventoryRepo->createIfNotExists($itemId);
                $inventory = $this->inventoryRepo->getByItemForUpdate($itemId);
            }

            $before = $inventory->quantity;

            $unitCost = 0;
            $totalCost = 0;

            if ($operation === 'increase') {

                $unitCost = $op['unit_cost']?? 0;
                $totalCost = $quantity * $unitCost;

                InventoryBatch::create([
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                    'remaining_quantity' => $quantity,
                    'unit_cost' => $unitCost,
                    'received_at' => now()
                ]);
            }

            if ($operation === 'decrease') {

                $batches = InventoryBatch::where('item_id', $itemId)
                    ->where('remaining_quantity', '>', 0)
                    ->orderBy('received_at')
                    ->lockForUpdate()
                    ->get();

                $remaining = $quantity;

                foreach ($batches as $batch) {

                    if ($remaining <= 0) break;

                    $take = min($batch->remaining_quantity, $remaining);

                    $batch->decrement('remaining_quantity', $take);

                    $totalCost += $take * $batch->unit_cost;

                    $remaining -= $take;
                }

                if ($remaining > 0) {
                    throw new \Exception(
                        "المخزون غير كافي للصنف " . getItemName($itemId)
                    );
                }

                $unitCost = $quantity > 0 ? $totalCost / $quantity : 0;
            }

            $after = $operation === 'increase'
                ? $before + $quantity
                : $before - $quantity;

            $this->inventoryRepo->updateQuantity($inventory, $after);

            $this->movementRepo->create([
                'item_id' => $itemId,
                'type' => $type,
                'quantity' => $quantity,
                'before_quantity' => $before,
                'after_quantity' => $after,
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost,
                'reference_id' => $reference->id,
                'reference_type' => get_class($reference),
            ]);

            $results[] = [
                'inventory' => $inventory,
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost
            ];
        }

        return $results;

    }, 5);
}

    public function calculateFifoCost(int $itemId, float $requiredQty): array
{
    $batches = InventoryBatch::where('item_id', $itemId)
        ->where('remaining_quantity', '>', 0)
        ->orderBy('received_at')
        ->lockForUpdate()
        ->get();

    $remaining = $requiredQty;
    $totalCost = 0;
    $totalQtyTaken = 0;

    foreach ($batches as $batch) {

        if ($remaining <= 0) break;

        $takeQty = min($batch->remaining_quantity, $remaining);

        $totalCost += $takeQty * $batch->unit_cost;
        $totalQtyTaken += $takeQty;

        $remaining -= $takeQty;
    }

    if ($remaining > 0) {
        return [
            'available' => false,
            'message' => "لا يوجد مخزون كافي للصنف " . getItemName($itemId)
        ];
    }

    return [
        'available' => true,
        'unit_cost' => $totalQtyTaken > 0 ? $totalCost / $totalQtyTaken : 0,
        'total_cost' => $totalCost
    ];
}
}