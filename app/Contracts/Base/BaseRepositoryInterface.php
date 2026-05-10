<?php

namespace App\Contracts\Base;

interface BaseRepositoryInterface
{
    public function paginate($perPage = 6, $filters = [], $search = null);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}