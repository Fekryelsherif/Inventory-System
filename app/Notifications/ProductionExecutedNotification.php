<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ProductionExecutedNotification extends Notification
{
    public function __construct(public $production) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم تنفيذ عملية إنتاج',
            'production_id' => $this->production->id
        ];
    }
}
