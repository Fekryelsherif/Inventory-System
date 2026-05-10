<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\OtpServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public $service;
    public function __construct(OtpServiceInterface $service)
    {
        $this->service = $service;
    }
   public function sendOtp(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $this->service->sendOtp($data['email']);

        return apiResponse('تم إرسال OTP');
    }


      public function resetPasswordWithOtp(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $this->service->resetPasswordWithOtp($data);

        return apiResponse('تم تغيير كلمة المرور بنجاح');
    }
}