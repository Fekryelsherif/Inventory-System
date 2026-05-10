<?php


namespace App\Services;

use App\Contracts\Repositories\ItemRepositoryInterface;
use App\Contracts\Services\ItemServiceInterface;

class ItemService extends BaseService implements ItemServiceInterface
{
    protected $repository;
    public function __construct(ItemRepositoryInterface $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function paginate($perPage = 6, $filters = [], $search = null)
    {
        return $this->repository->paginate($perPage, $filters, $search);
    }
}