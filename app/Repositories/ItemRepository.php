<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemRepositoryInterface;
use App\Models\Item;


class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function paginate($perPage = 6, $filters = [], $search = null)
{
    $query = $this->model->query();

    if ($search) {
        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%");

        });
    }

    foreach ($filters as $key => $value) {

        if (!is_null($value)) {
            $query->where($key, $value);
        }

    }

    return $query->paginate($perPage);
}
}
