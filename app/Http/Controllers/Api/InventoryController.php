<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\InventoryServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Item;

class InventoryController extends Controller
{
    protected $service;

    public function __construct(InventoryServiceInterface $service)
    {
        $this->service = $service;
    }

    public function processInventory()
    {
        $items=Item::all()->toArray();
        $results=$this->service->batchProcess($items, 'Inventory');

        return apiResponse('تم العملية بنجاح', $results, 200);

    }
}
