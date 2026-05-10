<?php

namespace App\Listeners;

use App\Events\PurchaseCreated;
use App\Models\User;
use App\Notifications\PurchaseCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPurchaseNotification implements ShouldQueue
{
    public function handle(PurchaseCreated $event)
    {
        $admin = User::first();
        $admin->notify(new PurchaseCreatedNotification($event->grn));

    }
}
