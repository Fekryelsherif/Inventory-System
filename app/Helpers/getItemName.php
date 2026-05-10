<?php

use App\Models\Item;



    function getItemName($itemId): string
    {
        return Item::find($itemId)?->name ?? "Item #{$itemId}";
    }