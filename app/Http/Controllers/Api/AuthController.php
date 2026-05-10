<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\AuthServiceInterface;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }



    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $result = $this->authService->login($data);

        if (!$result) {
            return ApiResponse('Invalid credentials', null, 401);
        }

        return apiResponse('تم تسجيل الدخول بنجاح', $result, 200);
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request->user());

        return apiResponse('تم تسجيل الخروج', null, 200);
    }

    public function refreshToken(Request $request)
    {
        $result = $this->authService->refreshToken($request->user());

        return apiResponse('تم تحديث التوكن', $result, 200);
    }
}
