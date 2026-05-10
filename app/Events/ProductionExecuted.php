<?php

namespace App\Events;

class ProductionExecuted
{
    public $production;

    public function __construct($production)
    {
        $this->production = $production;
    }
}
