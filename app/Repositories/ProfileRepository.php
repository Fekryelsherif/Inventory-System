<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProfileRepositoryInterface;
use Illuminate\Support\Facades\Storage;


class ProfileRepository implements ProfileRepositoryInterface
{

    public function get()
    {
        return auth()->user();
    }

    public function update(array $data)
    {
        return auth()->user()->update($data);
    }

    public function deleteProfileImage()
    {
        $user = auth()->user();
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
    }
}