<?php

namespace App\Contracts\Repositories;

interface OtpRepositoryInterface
{
    public function createOtp($userId, $otp);
    public function findValidOtp($otp);
    public function markUsed($otpRecord);
}