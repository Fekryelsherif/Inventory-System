<?php

namespace App\Repositories;

use App\Contracts\Repositories\StockMovementRepositoryInterface;
use App\Models\StockMovement;

class StockMovementRepository implements StockMovementRepositoryInterface
{
    public function create(array $data)
    {
        return StockMovement::create($data);
    }
}