<?php


namespace App\Services;

use App\Contracts\Repositories\UnitRepositoryInterface;
use App\Contracts\Services\UnitServiceInterface;

class UnitService extends BaseService implements UnitServiceInterface
{
    public function __construct(UnitRepositoryInterface $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }
}
