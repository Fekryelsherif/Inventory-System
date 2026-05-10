<?php

namespace App\Repositories;

use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Models\Otp;

class OtpRepository implements OtpRepositoryInterface
{
    public function createOtp($userId, $otp)
    {
        return Otp::create([
            'user_id' => $userId,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10)
        ]);
    }

    public function findValidOtp($otp)
    {
        return Otp::where('otp', $otp)
            ->where('used', false)
            ->where('expires_at', '>=', now())
            ->first();
    }

    public function markUsed($otpRecord)
    {
        $otpRecord->update(['used' => true]);
    }
}