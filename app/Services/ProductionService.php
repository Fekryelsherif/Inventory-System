<?php

namespace App\Services;

use App\Contracts\Repositories\ProductionRepositoryInterface;
use App\Contracts\Services\ProductionServiceInterface;
use App\Events\ProductionExecuted;
use App\Models\ProductionOrder;
use Illuminate\Support\Facades\DB;


class ProductionService implements ProductionServiceInterface
{
    protected $repository;
    protected $inventoryService;

    public function __construct(ProductionRepositoryInterface $repository, InventoryService $inventoryService)
    {
        $this->repository = $repository;
        $this->inventoryService = $inventoryService;
    }

    public function index($request)
    {
        return $this->repository->index($request);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function store($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {

        return $this->repository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

  public function execute(int $id)
{
    return DB::transaction(function () use ($id) {

        $order = ProductionOrder::with('recipe.items', 'recipe.output')
            ->lockForUpdate()
            ->findOrFail($id);

        if ($order->status === 'completed') {
            throw new \Exception('تم التنفيذ بالفعل');
        }

        $operations = [];
        $totalProductionCost = 0;

        foreach ($order->recipe->items as $item) {

            $requiredQty = $item->quantity * $order->quantity;

            $costData = $this->inventoryService->calculateFifoCost(
                $item->item_id,
                $requiredQty
            );

            if (!$costData['available']) {
                throw new \Exception($costData['message']);
            }

            $totalProductionCost += $costData['total_cost'];

            $operations[] = [
                'item_id' => $item->item_id,
                'quantity' => $requiredQty,
                'type' => 'production_out',
                'operation' => 'decrease'
            ];
        }

        $outputQty = $order->quantity * $order->recipe->output_quantity;

        $unitCost = $outputQty > 0
            ? $totalProductionCost / $outputQty
            : 0;

        $operations[] = [
            'item_id' => $order->recipe->output_item_id,
            'quantity' => $outputQty,
            'type' => 'production_in',
            'unit_cost' => $unitCost,
            'operation' => 'increase'
        ];

        $this->inventoryService->batchProcess($operations, $order);

        $order->update([
            'status' => 'completed',
            'total_cost' => $totalProductionCost
        ]);

        event(new ProductionExecuted($order));

        return $order->fresh(['recipe.items']);
    });
}

}