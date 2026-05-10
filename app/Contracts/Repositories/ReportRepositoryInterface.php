<?php

namespace App\Contracts\Repositories;


Interface ReportRepositoryInterface{
    public function InventoryReport();
    public function ProfitReport();
    public function MovementReport($request);
    public function VarianceReport();
    public function DailyReport();
    public function topProducts();

}
