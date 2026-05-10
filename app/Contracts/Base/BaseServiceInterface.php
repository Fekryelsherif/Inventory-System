<?php

namespace App\Contracts\Base;

interface BaseServiceInterface
{
    public function getAll($request);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
