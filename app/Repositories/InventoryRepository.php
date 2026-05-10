<?php

namespace App\Repositories;

use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Models\Inventory;

class InventoryRepository implements InventoryRepositoryInterface
{
    public function getByItemForUpdate($itemId)
    {
        return Inventory::where('item_id', $itemId)
            ->lockForUpdate()
            ->first();
    }

    public function createIfNotExists($itemId)
    {
        return Inventory::firstOrCreate(['item_id' => $itemId]);
    }


    public function updateQuantity($inventory, $newQuantity)
    {
        $inventory->update(['quantity' => $newQuantity]);
        return $inventory;
    }
}
