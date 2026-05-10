<?php

namespace App\Repositories;

use App\Contracts\Repositories\StockCountRepositoryInterface;
use App\Models\StockCount;

class StockCountRepository extends BaseRepository implements StockCountRepositoryInterface
{
    public function __construct(StockCount $model)
    {
        $this->model = $model;
    }
}
