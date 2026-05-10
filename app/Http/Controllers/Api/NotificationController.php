<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function unread()
    {
        return apiResponse(
            'الاشعارات الغير مقروءة',
            auth()->user()->unreadNotifications
        );
    }

    public function count()
    {
        return apiResponse(
            'عدد الاشعارات الغير مقروءة',
            ['count' => auth()->user()->unreadNotifications->count()]
        );
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return apiResponse('تم القراءة', $notification);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications
            ->markAsRead();

        return apiResponse('تم قراءة الكل', null);
    }

    public function destroy($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return apiResponse('تم الحذف', null);
    }
}
