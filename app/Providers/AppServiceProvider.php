<?php

namespace App\Providers;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\GRNRepositoryInterface;
use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Contracts\Repositories\ItemRepositoryInterface;
use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Contracts\Repositories\ProductionRepositoryInterface;
use App\Contracts\Repositories\ProfileRepositoryInterface;
use App\Contracts\Repositories\PurchaseRepositoryInterface;
use App\Contracts\Repositories\RecipeRepositoryInterface;
use App\Contracts\Repositories\ReportRepositoryInterface;
use App\Contracts\Repositories\StockCountRepositoryInterface;
use App\Contracts\Repositories\StockMovementRepositoryInterface;
use App\Contracts\Repositories\SupplierRepositoryInterface;
use App\Contracts\Repositories\UnitRepositoryInterface;
use App\Contracts\Repositories\WasteRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\GRNServiceInterface;
use App\Contracts\Services\InventoryServiceInterface;
use App\Contracts\Services\ItemServiceInterface;
use App\Contracts\Services\OrderServiceInterface;
use App\Contracts\Services\OtpServiceInterface;
use App\Contracts\Services\ProductionServiceInterface;
use App\Contracts\Services\ProfileServiceInterface;
use App\Contracts\Services\PurchaseServiceInterface;
use App\Contracts\Services\RecipeServiceInterface;
use App\Contracts\Services\ReportServiceInterface;
use App\Contracts\Services\StockCountServiceInterface;
use App\Contracts\Services\SupplierServiceInterface;
use App\Contracts\Services\UnitServiceInterface;
use App\Contracts\Services\WasteServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GRNRepository;
use App\Repositories\InventoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OtpRepository;
use App\Repositories\ProductionRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\PurchaseRepository;
use App\Repositories\RecipeRepository;
use App\Repositories\ReportRepository;
use App\Repositories\StockCountRepository;
use App\Repositories\StockMovementRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\UnitRepository;
use App\Repositories\WasteRepository;
use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\GRNService;
use App\Services\InventoryService;
use App\Services\ItemService;
use App\Services\OrderService;
use App\Services\OtpService;
use App\Services\ProductionService;
use App\Services\ProfileService;
use App\Services\PurchaseService;
use App\Services\RecipeService;
use App\Services\ReportService;
use App\Services\StockCountService;
use App\Services\SupplierService;
use App\Services\UnitService;
use App\Services\WasteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(ItemRepositoryInterface::class,ItemRepository::class);
        $this->app->bind(PurchaseRepositoryInterface::class,PurchaseRepository::class);
        $this->app->bind(ProductionRepositoryInterface::class,ProductionRepository::class);
        $this->app->bind(GRNRepositoryInterface::class,GRNRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class,InventoryRepository::class);
        $this->app->bind(StockMovementRepositoryInterface::class,StockMovementRepository::class);
        $this->app->bind(OtpRepositoryInterface::class,OtpRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
        $this->app->bind(UnitRepositoryInterface::class,UnitRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class,SupplierRepository::class);
        $this->app->bind(RecipeRepositoryInterface::class,RecipeRepository::class);
        $this->app->bind(StockCountRepositoryInterface::class,StockCountRepository::class);
        $this->app->bind(WasteRepositoryInterface::class,WasteRepository::class);
        $this->app->bind(ReportRepositoryInterface::class,ReportRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class,ProfileRepository::class);



        //Services
        $this->app->bind(ItemServiceInterface::class,ItemService::class);
        $this->app->bind(CategoryServiceInterface::class,CategoryService::class);
        $this->app->bind(AuthServiceInterface::class,AuthService::class);
        $this->app->bind(GRNServiceInterface::class,GRNService::class);
        $this->app->bind(UnitServiceInterface::class,UnitService::class);
        $this->app->bind(SupplierServiceInterface::class,SupplierService::class);
        $this->app->bind(RecipeServiceInterface::class,RecipeService::class);
        $this->app->bind(WasteServiceInterface::class,WasteService::class);
        $this->app->bind(ReportServiceInterface::class,ReportService::class);
        $this->app->bind(InventoryServiceInterface::class,InventoryService::class);
        $this->app->bind(PurchaseServiceInterface::class,PurchaseService::class);
        $this->app->bind(ProductionServiceInterface::class,ProductionService::class);
        $this->app->bind(OrderServiceInterface::class,OrderService::class);
        $this->app->bind(StockCountServiceInterface::class,StockCountService::class);
        $this->app->bind(ProfileServiceInterface::class,ProfileService::class);
        $this->app->bind(OtpServiceInterface::class,OtpService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
