<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class SendOrderNotification
{
    public function handle(OrderCreated $event)
    {
        $admin = User::first();

        $admin->notify(new OrderCreatedNotification($event->order));
    }
}
