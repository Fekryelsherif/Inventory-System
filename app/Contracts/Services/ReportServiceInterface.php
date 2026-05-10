<?php

namespace App\Contracts\Services;


Interface ReportServiceInterface{
    public function InventoryReport();
    public function ProfitReport();
    public function MovementReport($request);
    public function VarianceReport();
    public function DailyReport();
    public function topProducts();
}
