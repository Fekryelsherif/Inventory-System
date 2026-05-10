<?php

namespace   App\Contracts\Repositories;

interface InventoryRepositoryInterface
{
    public function getByItemForUpdate($itemId);
    public function createIfNotExists($itemId);
    public function updateQuantity($inventory, $newQuantity);
}
