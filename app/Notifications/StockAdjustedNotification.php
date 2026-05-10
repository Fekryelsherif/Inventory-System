<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;


class StockAdjustedNotification extends Notification
{
    public function __construct(public $stockCount) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم تنفيذ الجرد والتسوية',
            'stock_count_id' => $this->stockCount->id
        ];
    }
}
