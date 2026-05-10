<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    public function __construct(public $order) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم إنشاء طلب جديد',
            'order_id' => $this->order->id,
            'total' => $this->order->total
        ];
    }
}
