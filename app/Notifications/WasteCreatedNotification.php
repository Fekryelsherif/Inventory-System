<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class WasteCreatedNotification extends Notification
{
    public function __construct(public $waste) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم تسجيل هالك',
            'waste_id' => $this->waste->id
        ];
    }
}
