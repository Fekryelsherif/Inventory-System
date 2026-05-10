<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ProfileServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileServiceInterface $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        return apiResponse('تم جلب بيانات المستخدم', $this->service->get(),200);
    }


    public function update(Request $request)
    {
        $data=$request->validate([
            'fname' => 'sometimes|string',
            'lname' => 'sometimes|string',
            'email' => 'sometimes|email|exists:users,email',
            'phone' => 'sometimes|string',
            'address' => 'nullable|string',
        ]);
        // عايز امسح الصورة القديمة واضيف الجديد
        if ($request->hasFile('profile_image')) {
            $this->service->deleteProfileImage();
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }
        return apiResponse('تم تحديث بيانات المستخدم', $this->service->update($data),200);
    }
}