<?php

namespace App\Contracts\Services;


Interface InventoryServiceInterface{
    public function batchProcess(array $operations, $reference);
    public function calculateFifoCost(int $itemId, float $requiredQty);
}
