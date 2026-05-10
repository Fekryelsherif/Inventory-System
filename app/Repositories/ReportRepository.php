<?php

namespace App\Repositories;

use App\Contracts\Repositories\ReportRepositoryInterface;
use App\Models\InventoryBatch;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockCountItem;
use App\Models\StockMovement;
use App\Models\WasteItem;

class ReportRepository implements ReportRepositoryInterface
{
    //InventoryReport
    public function InventoryReport()
    {
        return InventoryBatch::selectRaw('
            item_id,
            SUM(remaining_quantity) as quantity,
            SUM(remaining_quantity * unit_cost) as value
        ')
        ->groupBy('item_id')
        ->get();
    }

    // ProfitReport

     public function ProfitReport()
    {
        return Order::with('items')->get()->map(function ($order) {

            $revenue = $order->items->sum(fn($i) => $i->selling_price * $i->quantity);
            $cost = $order->items->sum('total_cost');

            return [
                'order_id' => $order->id,
                'revenue' => $revenue,
                'cost' => $cost,
                'profit' => $revenue - $cost
            ];
        });
    }

    // MovementReport
    public function MovementReport($request)
{
    return StockMovement::query()
        ->when($request->filled('item_id'), fn($q) => 
            $q->where('item_id', $request->item_id)
        )
        ->when($request->filled('type'), fn($q) => 
            $q->where('type', $request->type)
        )
        ->latest()
        ->paginate(6);
}

    // VarianceReport
    public function VarianceReport()
    {
        return StockCountItem::where('difference', '!=', 0)->get();
    }


    // DailyReport
    public function DailyReport()
    {
        return [
            'sales' => Order::where('created_at', '>=', now()->subDay())
                ->sum('total'),

            'cost' => Order::where('created_at', '>=', now()->subDay())
                ->sum('total_cost'),

            'profit' => Order::where('created_at', '>=', now()->subDay())
                ->sum('profit'),

            'waste' => WasteItem::where('created_at', '>=', now()->subDay())
                ->sum('total_cost')
        ];
    }

    public function topProducts()
    {
        return OrderItem::selectRaw('
            item_id,
            SUM(quantity) as total_sold
        ')
        ->groupBy('item_id')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();
    }
}