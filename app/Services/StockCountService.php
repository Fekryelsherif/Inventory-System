<?php

namespace App\Services;

use App\Contracts\Repositories\StockCountRepositoryInterface;
use App\Contracts\Services\StockCountServiceInterface;
use App\Events\StockAdjusted;
use App\Models\Inventory;
use App\Models\InventoryBatch;
use App\Models\StockCount;
use Illuminate\Support\Facades\DB;

class StockCountService implements StockCountServiceInterface
{
    protected $inventoryService;
    protected $repository;

    public function __construct(StockCountRepositoryInterface $repository,InventoryService $inventoryService) {
        $this->repository = $repository;
        $this->inventoryService = $inventoryService;
    }

    public function create($data)
{
    return DB::transaction(function () use ($data) {

        if (empty($data['items'])) {
            throw new \Exception('يجب إدخال أصناف الجرد');
        }

        $count = $this->repository->create([
            'status' => 'pending'
        ]);

        foreach ($data['items'] as $item) {

            $itemId = $item['item_id'];

            $inventory = Inventory::where('item_id', $itemId)->first();

            $systemQty = $inventory ? $inventory->quantity : 0;
            $actualQty = $item['actual_quantity'];

            $diff = $actualQty - $systemQty;

            $unitCost = 0;
            $totalCost = 0;

            if ($diff > 0) {

                $lastBatch = InventoryBatch::where('item_id', $itemId)
                    ->orderByDesc('received_at')
                    ->first();

                $unitCost = $lastBatch ? $lastBatch->unit_cost : 0;
                $totalCost = $diff * $unitCost;
            }

           
            if ($diff < 0) {

                $requiredQty = abs($diff);

                $costData = $this->inventoryService->calculateFifoCost(
                    $itemId,
                    $requiredQty
                );

                if (!$costData['available']) {
                    throw new \Exception(
                        "المخزون غير كافي للصنف " . getItemName($itemId)
                    );
                }

                $unitCost = $costData['unit_cost'];
                $totalCost = $costData['total_cost'];
            }

            $count->items()->create([
                'item_id' => $itemId,
                'system_quantity' => $systemQty,
                'actual_quantity' => $actualQty,
                'difference' => $diff,
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost
            ]);
        }

        event(new StockAdjusted($count));

        return $count->load('items');
    });
}

    public function applyAdjustment($id)
{
    return DB::transaction(function () use ($id) {

        $count = StockCount::with('items')->lockForUpdate()->findOrFail($id);

        if ($count->status === 'completed') {
            throw new \Exception('تم التنفيذ مسبقًا');
        }

        $operations = [];
        $map = [];

        foreach ($count->items as $item) {

            if ($item->difference == 0) {
                continue;
            }

            $operation = $item->difference > 0 ? 'increase' : 'decrease';
            $qty = abs($item->difference);

            $op = [
                'item_id' => $item->item_id,
                'quantity' => $qty,
                'type' => 'adjustment',
                'operation' => $operation
            ];

            if ($operation === 'increase') {
                $op['unit_cost'] = $item->unit_cost;
            }

            $operations[] = $op;
            $map[] = $item;
        }

        $results = $this->inventoryService->batchProcess($operations, $count);

        foreach ($map as $index => $item) {

            $item->update([
                'unit_cost' => $results[$index]['unit_cost'],
                'total_cost' => $results[$index]['total_cost']
            ]);
        }

        $count->update(['status' => 'completed']);

        return $count->load('items');
    });
}
   
   public function getAll($request){
        return StockCount::with('items')->paginate();
    }

    public function getById($id)
    {
        return StockCount::with('items')->findOrFail($id);
    }

   public function update($id, $data)
   {
    return DB::transaction(function () use ($id, $data) {

        $count = StockCount::with('items')->lockForUpdate()->findOrFail($id);

        if ($count->status === 'completed') {
            throw new \Exception('تم التنفيذ مسبقًا');
        }

        if (empty($data['items'])) {
            throw new \Exception('يجب إدخال أصناف الجرد');
        }

        $count->items()->delete();

        foreach ($data['items'] as $item) {

            $itemId = $item['item_id'];

            $inventory = Inventory::where('item_id', $itemId)->first();

            $systemQty = $inventory ? $inventory->quantity : 0;
            $actualQty = $item['actual_quantity'];

            $diff = $actualQty - $systemQty;

            $unitCost = 0;
            $totalCost = 0;

            if ($diff > 0) {

                $lastBatch = InventoryBatch::where('item_id', $itemId)
                    ->orderByDesc('received_at')
                    ->first();

                $unitCost = $lastBatch ? $lastBatch->unit_cost : 0;
                $totalCost = $diff * $unitCost;
            }

            if ($diff < 0) {

                $requiredQty = abs($diff);

                $costData = $this->inventoryService->calculateFifoCost(
                    $itemId,
                    $requiredQty
                );

                if (!$costData['available']) {
                    throw new \Exception("المخزون غير كافي للصنف " . getItemName($itemId));
                }

                $unitCost = $costData['unit_cost'];
                $totalCost = $costData['total_cost'];
            }

            $count->items()->create([
                'item_id' => $itemId,
                'system_quantity' => $systemQty,
                'actual_quantity' => $actualQty,
                'difference' => $diff,
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost
            ]);
        }

        if (!empty($data['status'])) {
            $count->update(['status' => $data['status']]);
        }

        return $count->load('items');
    });
}

    public function delete($id)
    {
        return StockCount::with('items')->findOrFail($id)->delete();
    }
}