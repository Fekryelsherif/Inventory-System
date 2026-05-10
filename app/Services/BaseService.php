<?php

namespace App\Services;

use App\Contracts\Base\BaseRepositoryInterface;
use App\Contracts\Base\BaseServiceInterface;

class BaseService implements BaseServiceInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository=$repository;
    }

    public function getAll($request)
    {
        return $this->repository->paginate(
            6,
            $request->filters ?? [],
            $request->search ?? null
        );
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
