<?php

namespace App\Services;

use App\Contracts\Repositories\ProfileRepositoryInterface;
use App\Contracts\Services\ProfileServiceInterface;

class ProfileService implements ProfileServiceInterface
{
    protected $repository;
    public function __construct(ProfileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        return $this->repository->get();
    }

    public function update(array $data)
    {
        return $this->repository->update($data);
    }

    public function deleteProfileImage()
    {
        return $this->repository->deleteProfileImage();
    }
}