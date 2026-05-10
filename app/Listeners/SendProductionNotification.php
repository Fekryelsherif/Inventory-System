<?php

namespace App\Listeners;

use App\Events\ProductionExecuted;
use App\Models\User;
use App\Notifications\ProductionExecutedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProductionNotification implements ShouldQueue
{
    public function handle(ProductionExecuted $event)
    {
        $admin=User::first();
        $admin->notify(new ProductionExecutedNotification($event->production));
    }
}
