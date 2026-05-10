<?php

namespace App\Contracts\Services;

use App\Contracts\Base\BaseServiceInterface;

interface ItemServiceInterface extends BaseServiceInterface
{
    public function paginate($perPage = 6, $filters = [], $search = null);
}
