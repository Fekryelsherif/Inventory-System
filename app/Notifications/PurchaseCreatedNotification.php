<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class PurchaseCreatedNotification extends Notification
{
    public function __construct(public $grn) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم استلام بضاعة جديدة',
            'grn_id' => $this->grn->id
        ];
    }
}