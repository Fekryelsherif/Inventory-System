<?php

namespace App\Services;

use App\Contracts\Repositories\ReportRepositoryInterface;
use App\Contracts\Services\ReportServiceInterface;

class ReportService implements ReportServiceInterface
{

    protected $repository;
    public function __construct(ReportRepositoryInterface $repository )
    {
        $this->repository = $repository;
    }

    public function InventoryReport()
    {
        return $this->repository->InventoryReport();
    }

    public function ProfitReport()
    {
        return $this->repository->ProfitReport();
    }

    public function MovementReport($request)
    {
        return $this->repository->MovementReport($request);
    }

    public function VarianceReport()
    {
        return $this->repository->VarianceReport();
    }

    public function DailyReport()
    {
        return $this->repository->DailyReport();
    }

    public function topProducts()
    {
        return $this->repository->topProducts();
    }

}