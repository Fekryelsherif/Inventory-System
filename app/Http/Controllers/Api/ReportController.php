<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ReportServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportServiceInterface $reportService)
    {
        $this->reportService = $reportService;
    }

    public function InventoryReport()
    {
        return apiResponse('تقارير المخزون',$this->reportService->InventoryReport(),200);
    }

    public function ProfitReport()
    {
        return apiResponse('تقارير الربح',$this->reportService->ProfitReport(),200);
    }

    public function MovementReport(Request $request)
    {
        return apiResponse('تقارير الحركات',$this->reportService->MovementReport($request),200);
    }

    public function VarianceReport()
    {
        return apiResponse('تقارير الاختلاف',$this->reportService->VarianceReport(),200);
    }

    public function DailyReport()
    {
        return apiResponse('تقارير اليومية',$this->reportService->DailyReport(),200);
    }

    public function topProducts()
    {
        return apiResponse('المنتجات الاكثر مبيعا',$this->reportService->topProducts(),200);
    }
}