<?php

namespace App\Events;



class PurchaseCreated
{
    public $grn;

    public function __construct($grn)
    {
        $this->grn = $grn;
    }
}
