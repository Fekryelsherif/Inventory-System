<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductionRepositoryInterface;
use App\Models\ProductionOrder;

class ProductionRepository implements ProductionRepositoryInterface
{

    public function index($request)
    {
        return ProductionOrder::with('recipe')->paginate(6);
    }

    public function show($id)
    {
        return ProductionOrder::with('recipe')->findOrFail($id);
    }

    public function create($data)
    {
        return ProductionOrder::create([
            'recipe_id' => $data['recipe_id'],
            'quantity' => $data['quantity']
        ]);
    }

    public function update($id, $data)
    {
        $order = ProductionOrder::findOrFail($id);

        if ($order->status === 'completed') {
            throw new \Exception('لا يمكن تعديل بعد التنفيذ');
        }

        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = ProductionOrder::findOrFail($id);

        if ($order->status === 'completed') {
            throw new \Exception('لا يمكن الحذف بعد التنفيذ');
        }

        return $order->delete();
    }


}
