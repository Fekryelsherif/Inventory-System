<?php

namespace App\Contracts\Repositories;


Interface ProfileRepositoryInterface
{
    public function get();
    public function update(array $data);
    public function deleteProfileImage();
}