<?php

namespace App\Contracts\Services;

Interface ProfileServiceInterface
{
    public function get();
    public function update(array $data);
    public function deleteProfileImage();
}