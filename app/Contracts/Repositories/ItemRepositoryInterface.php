<?php

namespace App\Contracts\Repositories;

use App\Contracts\Base\BaseRepositoryInterface;

interface ItemRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate($perPage = 6, $filters = [], $search = null);
}
