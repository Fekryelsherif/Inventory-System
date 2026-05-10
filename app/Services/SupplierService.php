<?php


namespace App\Services;

use App\Contracts\Repositories\SupplierRepositoryInterface;
use App\Contracts\Services\SupplierServiceInterface;

class SupplierService extends BaseService implements SupplierServiceInterface
{
    public function __construct(SupplierRepositoryInterface $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }
}