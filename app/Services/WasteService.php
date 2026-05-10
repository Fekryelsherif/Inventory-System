<?php

namespace App\Services;

use App\Contracts\Repositories\WasteRepositoryInterface;
use App\Contracts\Services\WasteServiceInterface;
use App\Events\WasteCreated;
use App\Models\Waste;
use Illuminate\Support\Facades\DB;

class WasteService implements WasteServiceInterface
{
    protected $inventoryService;
    protected $repository;

    public function __construct(WasteRepositoryInterface $repository,InventoryService $inventoryService) {
        $this->repository = $repository;
        $this->inventoryService = $inventoryService;
    }

   public function create($data)
{
    return DB::transaction(function () use ($data) {

        if (empty($data['items'])) {
            throw new \Exception('يجب إدخال أصناف الهالك');
        }

        $waste = $this->repository->create([
            'reason' => $data['reason'] ?? null
        ]);

        $operations = [];
        $map = [];

        foreach ($data['items'] as $item) {

            $operations[] = [
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'type' => 'waste',
                'operation' => 'decrease'
            ];

            $map[] = $item;
        }

        $results = $this->inventoryService->batchProcess($operations, $waste);

        foreach ($map as $index => $item) {

            $unitCost = $results[$index]['unit_cost'];
            $totalCost = $results[$index]['total_cost'];

            $waste->items()->create([
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost
            ]);
        }

        event(new WasteCreated($waste));

        return $waste->load('items');
    });
}

   public function update($id, $data)
{
    return DB::transaction(function () use ($id, $data) {

        $waste = $this->repository->find($id);

        if (empty($data['items'])) {
            throw new \Exception('يجب إدخال أصناف الهالك');
        }

        /*
        |------------------------------------------
        | 1. Reverse old waste (رجّع المخزون)
        |------------------------------------------
        */
        foreach ($waste->items as $oldItem) {

            $this->inventoryService->batchProcess([
                [
                    'item_id' => $oldItem->item_id,
                    'quantity' => $oldItem->quantity,
                    'type' => 'adjustment',
                    'operation' => 'increase',
                    'unit_cost' => $oldItem->unit_cost
                ]
            ], $waste);
        }

        $waste->items()->delete();

        /*
        |------------------------------------------
        | 2. Re-process waste بنفس منطق create
        |------------------------------------------
        */
        $operations = [];
        $map = [];

        foreach ($data['items'] as $item) {

            $operations[] = [
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'type' => 'waste',
                'operation' => 'decrease'
            ];

            $map[] = $item;
        }

        $results = $this->inventoryService->batchProcess($operations, $waste);

        foreach ($map as $index => $item) {

            $waste->items()->create([
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'unit_cost' => $results[$index]['unit_cost'],
                'total_cost' => $results[$index]['total_cost']
            ]);
        }

        $waste->update([
            'reason' => $data['reason'] ?? $waste->reason
        ]);

        return $waste->load('items');
    });
}

    public function delete($id)
    {
        $waste=Waste::with('items')->findOrFail($id)->delete();
        return $waste;
    }

    public function getById($id)
    {
        return Waste::with('items')->findOrFail($id);
    }

    public function getAll($request)
    {
        return Waste::with('items')->paginate();
    }
}