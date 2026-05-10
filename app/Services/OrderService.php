<?php

namespace App\Services;

use App\Contracts\Services\OrderServiceInterface;
use App\Events\OrderCreated;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

  public function create(array $data)
{
    return DB::transaction(function () use ($data) {

        if (empty($data['items'])) {
            throw new \Exception('يجب إضافة صنف واحد على الأقل للطلب');
        }

        $order = Order::create();

        $total = 0;
        $totalCost = 0;

        foreach ($data['items'] as $item) {

            $model = Item::findOrFail($item['item_id']);

            if ($model->type !== 'finished') {
                throw new \Exception(
                    "لا يمكن بيع الصنف " . getItemName($model->id) . " لأنه ليس منتج نهائي"
                );
            }

            $quantity = $item['quantity'];
            $price = $item['selling_price'];

            $operations = [
                [
                    'item_id' => $model->id,
                    'quantity' => $quantity,
                    'type' => 'sale',
                    'operation' => 'decrease'
                ]
            ];

            $results = $this->inventoryService->batchProcess($operations, $order);

            $itemCost = 0;
            foreach ($results as $res) {
                $itemCost += $res['total_cost'];
            }

            $unitCost = $quantity > 0 ? $itemCost / $quantity : 0;
            $profit = ($price * $quantity) - $itemCost;

            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $model->id,
                'quantity' => $quantity,
                'selling_price' => $price,
                'unit_cost' => $unitCost,
                'total_cost' => $itemCost,
                'profit' => $profit,
                'total' => $price * $quantity
            ]);

            $total += $price * $quantity;
            $totalCost += $itemCost;
        }

        $order->update([
            'total' => $total,
            'total_cost' => $totalCost,
            'profit' => $total - $totalCost,
            'status' => 'completed'
        ]);

        event(new OrderCreated($order));

        return $order->fresh(['items']);
    });
}

public function update($id, $data)
{
    return DB::transaction(function () use ($id, $data) {

        $order = Order::with('items')->lockForUpdate()->findOrFail($id);

        if (empty($data['items'])) {
            throw new \Exception('يجب إضافة صنف واحد على الأقل للطلب');
        }

        /*
        |--------------------------------------------------------------------------
        | 1. Reverse old stock (SAFE adjustment)
        |--------------------------------------------------------------------------
        */
        foreach ($order->items as $oldItem) {

            $this->inventoryService->batchProcess([
                [
                    'item_id' => $oldItem->item_id,
                    'quantity' => $oldItem->quantity,
                    'type' => 'adjustment',
                    'operation' => 'increase'
                ]
            ], $order);
        }

        $order->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | 2. Recreate order as new sale (SAME AS CREATE)
        |--------------------------------------------------------------------------
        */
        $total = 0;
        $totalCost = 0;

        foreach ($data['items'] as $item) {

            $model = Item::findOrFail($item['item_id']);

            if ($model->type !== 'finished') {
                throw new \Exception("لا يمكن بيع هذا المنتج " . getItemName($model->id));
            }

            $quantity = $item['quantity'];
            $price = $item['selling_price'];

            $results = $this->inventoryService->batchProcess([
                [
                    'item_id' => $model->id,
                    'quantity' => $quantity,
                    'type' => 'sale',
                    'operation' => 'decrease'
                ]
            ], $order);

            $itemCost = array_sum(array_column($results, 'total_cost'));

            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $model->id,
                'quantity' => $quantity,
                'selling_price' => $price,
                'unit_cost' => $quantity ? $itemCost / $quantity : 0,
                'total_cost' => $itemCost,
                'profit' => ($price * $quantity) - $itemCost
            ]);

            $total += $price * $quantity;
            $totalCost += $itemCost;
        }

        $order->update([
            'total' => $total,
            'total_cost' => $totalCost,
            'profit' => $total - $totalCost
        ]);

        return $order->fresh(['items']);
    });
}


    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $order = Order::findOrFail($id);
            foreach ($order->items as $item) {
                $item->delete();
            }
            $order->delete();
            return $order;
        });
    }


    public function index()
    {
        return Order::with('items')->paginate(6);
    }


    public function show($id)
    {
        return Order::with('items')->findOrFail($id);
    }


}