<?php

namespace App\Contracts\Services;

interface OtpServiceInterface
{
    public function sendOtp($email);
    public function resetPasswordWithOtp($data);
}