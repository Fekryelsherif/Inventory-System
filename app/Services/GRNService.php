<?php

namespace App\Services;

use App\Contracts\Repositories\GRNRepositoryInterface;
use App\Contracts\Services\GRNServiceInterface;
use App\Contracts\Services\InventoryServiceInterface;
use App\Events\PurchaseCreated;
use App\Models\Grn;
use App\Models\GrnItem;
use App\Models\PurchaseOrderItem;
use Illuminate\Support\Facades\DB;

class GRNService implements GRNServiceInterface
{
    protected GRNRepositoryInterface $repository;
    protected $inventoryService;

    public function __construct(GRNRepositoryInterface $repository, InventoryServiceInterface $inventoryService )
    {
        $this->repository = $repository;
        $this->inventoryService = $inventoryService;
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

   public function create($data)
{
    return DB::transaction(function () use ($data) {

        $grn = Grn::create([
            'purchase_order_id' => $data['purchase_order_id']
        ]);

        $operations = [];

        foreach ($data['items'] as $item) {

            $poItem = PurchaseOrderItem::where([
                'purchase_order_id' => $data['purchase_order_id'],
                'item_id' => $item['item_id']
            ])->firstOrFail();

            GrnItem::create([
                'grn_id' => $grn->id,
                'item_id' => $item['item_id'],
                'received_quantity' => $item['received_quantity']
            ]);

            $operations[] = [
                'item_id' => $item['item_id'],
                'quantity' => $item['received_quantity'],
                'type' => 'purchase',
                'unit_cost' => $poItem->price,
                'total_cost' => $item['received_quantity'] * $poItem->price,
                'operation' => 'increase'
            ];
        }

        $this->inventoryService->batchProcess($operations, $grn);

        event(new PurchaseCreated($grn));

        return $grn;
    });
}
}
