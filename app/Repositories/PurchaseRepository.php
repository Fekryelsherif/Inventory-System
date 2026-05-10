<?php

namespace App\Repositories;

use App\Contracts\Repositories\PurchaseRepositoryInterface;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class PurchaseRepository implements PurchaseRepositoryInterface
{

    public function create($data)
    {
        $po = PurchaseOrder::create([
            'supplier_id' => $data['supplier_id']
        ]);
        
        foreach ($data['items'] as $item) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['quantity'] * $item['price'],
            ]);
        }

        return[
            'po' => $po,
            'items' => PurchaseOrderItem::with('item')->where('purchase_order_id', $po->id)->get()
        ];
    }

     public function show($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);
        $poItems = PurchaseOrderItem::with('item')->where('purchase_order_id', $id)->get();
        return [
            'po' => $po,
            'items' => $poItems
        ];
    }

    public function index(){
        return PurchaseOrder::with('items')->paginate(6);

    }

    public function update($id, $data){
        $po = PurchaseOrder::findOrFail($id);
        $poItems = PurchaseOrderItem::where('purchase_order_id', $id)->get();
        foreach ($poItems as $poItem) {
            $poItem->update([
                'quantity' => $data['items'][$poItem->item_id]['quantity'],
                'price' => $data['items'][$poItem->item_id]['price'],
            ]);
        }
        $po->update($data);
        return $po;
    }

    public function delete($id){
        $po = PurchaseOrder::findOrFail($id);
        $proItems = PurchaseOrderItem::where('purchase_order_id', $id)->get();
        foreach ($proItems as $proItem) {
            $proItem->delete();
        }
        $po->delete();
        return $po;
    }




}