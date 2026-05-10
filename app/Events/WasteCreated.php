<?php

namespace App\Events;

class WasteCreated
{
    public $waste;

    public function __construct($waste)
    {
        $this->waste = $waste;
    }
}
