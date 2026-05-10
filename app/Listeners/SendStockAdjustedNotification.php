<?php

namespace App\Listeners;

use App\Events\StockAdjusted;
use App\Models\User;
use App\Notifications\StockAdjustedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStockAdjustedNotification implements ShouldQueue
{
    public function handle(StockAdjusted $event)
    {
        $admin=User::first();
        $admin->notify(new StockAdjustedNotification($event->stockCount));

    }
}
