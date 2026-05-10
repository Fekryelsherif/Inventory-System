<?php

namespace App\Repositories;

use App\Contracts\Repositories\UnitRepositoryInterface;
use App\Models\Unit;

class UnitRepository extends BaseRepository implements UnitRepositoryInterface
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }
}
