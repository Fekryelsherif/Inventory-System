<?php

namespace App\Contracts\Repositories;

interface AuthRepositoryInterface
{
    public function createUser(array $data);
    public function findByEmail($email);
}