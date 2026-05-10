<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Repositories\AuthRepositoryInterface;

class AuthService extends BaseService implements AuthServiceInterface
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->authRepo->createUser($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,

        ];
    }

    public function login(array $data)
    {
        $user = $this->authRepo->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout($user)
    {
        $user->tokens()->delete();
    }

    public function refreshToken($user)
    {
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [

            'token' => $token
        ];
    }
}