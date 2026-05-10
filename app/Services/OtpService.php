<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Services\OtpServiceInterface;
use App\Contracts\Repositories\OtpRepositoryInterface;

class OtpService implements OtpServiceInterface
{
    protected $otpRepo;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function sendOtp($email)
    {
        $user = User::where('email', $email)->firstOrFail();

        $otp = rand(100000, 999999);

        $this->otpRepo->createOtp($user->id, $otp);

        Mail::raw("OTP Code: $otp", function ($msg) use ($email) {
            $msg->to($email)->subject('OTP Verification');
        });

        return true;
    }

    public function resetPasswordWithOtp($data)
    {
        $otpRecord = $this->otpRepo->findValidOtp($data['otp']);

        if (!$otpRecord) {
            abort(400, 'OTP غير صحيح أو منتهي');
        }

        $user = User::findOrFail($otpRecord->user_id);

        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        $this->otpRepo->markUsed($otpRecord);

        return true;
    }
}