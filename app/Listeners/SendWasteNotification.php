<?php

namespace App\Listeners;

use App\Events\WasteCreated;
use App\Models\User;
use App\Notifications\WasteCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWasteNotification implements ShouldQueue
{
    public function handle(WasteCreated $event)
    {
        $admin = User::first();
        $admin->notify(new WasteCreatedNotification($event->waste));

    }
}
