<?php

namespace App\Events;


class StockAdjusted
{
    public $stockCount;

    public function __construct($stockCount)
    {
        $this->stockCount = $stockCount;
    }
}
