<?php

namespace App\Repositories;

use App\Contracts\Repositories\GRNRepositoryInterface;
use App\Models\Grn;
use App\Models\GrnItem;

class GRNRepository implements GRNRepositoryInterface
{


    public function show($id)
    {
       $grn = Grn::with('items')->findOrFail($id);
       $grnItems = GrnItem::with('item')->where('grn_id', $id)->get();
       return [
           'grn' => $grn,
           'items' => $grnItems
       ];
    }

    public function index(){
        return Grn::with(['purchase_order', 'items.item'])->withCount('items')->paginate(6);
    }

    public function update($id, $data)
    {
        $grn = Grn::findOrFail($id);

        $items = collect($data['items'])->keyBy('item_id');

        $grnItems = GrnItem::where('grn_id', $id)->get();

        foreach ($grnItems as $grnItem) {

            if (isset($items[$grnItem->item_id])) {

                $grnItem->update([
                    'received_quantity' => $items[$grnItem->item_id]['received_quantity']
                ]);
            }
        }

        $grn->update([
            'purchase_order_id' => $data['purchase_order_id'] ?? $grn->purchase_order_id
        ]);

        return $grn;
    }

    public function delete($id){
        $grn = Grn::findOrFail($id);
        $grnItems = GrnItem::where('grn_id', $id)->get();
        foreach ($grnItems as $grnItem) {
            $grnItem->delete();
        }
        $grn->delete();
        return $grn;
    }

}
