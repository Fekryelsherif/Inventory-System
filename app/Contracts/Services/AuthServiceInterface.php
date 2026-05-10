<?php
namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout($user);
    public function refreshToken($user);
}