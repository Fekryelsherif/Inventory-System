<?php

namespace App\Repositories;

use App\Contracts\Repositories\WasteRepositoryInterface;
use App\Models\Waste;

class WasteRepository extends BaseRepository implements WasteRepositoryInterface
{
    public function __construct(Waste $model)
    {
        $this->model = $model;
    }
}