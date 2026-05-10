<?php

namespace App\Events;



class OrderCreated
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
}
