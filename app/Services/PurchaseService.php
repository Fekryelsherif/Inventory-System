<?php

namespace App\Services;

use App\Contracts\Repositories\PurchaseRepositoryInterface;
use App\Contracts\Services\PurchaseServiceInterface;

class PurchaseService implements PurchaseServiceInterface
{
    protected $repository;

    public function __construct(PurchaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

     public function show($id)
    {
        return $this->repository->show($id);
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }


}
