<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GRNController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\ProductionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StockCountController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\WasteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


















/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('send-otp', [OtpController::class, 'sendOtp']);
    Route::post('reset-password-otp', [OtpController::class, 'resetPasswordWithOtp']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh-token', [AuthController::class, 'refreshToken']);
    });
});

Route::prefix('/items')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[ItemController::class, 'index']);
    Route::post('/', [ItemController::class, 'store']);
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::put('/{id}/', [ItemController::class, 'update']);
    Route::delete('/{id}/', [ItemController::class, 'destroy']);
});

Route::prefix('/units')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[UnitController::class, 'index']);
    Route::post('/', [UnitController::class, 'store']);
    Route::get('/{id}', [UnitController::class, 'show']);
    Route::put('/{id}/', [UnitController::class, 'update']);
    Route::delete('/{id}/', [UnitController::class, 'destroy']);
});


Route::prefix('/categories')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}/', [CategoryController::class, 'update']);
    Route::delete('/{id}/', [CategoryController::class, 'destroy']);
});

Route::prefix('/suppliers')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[SupplierController::class, 'index']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::put('/{id}/', [SupplierController::class, 'update']);
    Route::delete('/{id}/', [SupplierController::class, 'destroy']);
});

Route::prefix('/purchases')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[PurchaseController::class, 'index']);
    Route::post('/', [PurchaseController::class, 'store']);
    Route::get('/{id}', [PurchaseController::class, 'show']);
    Route::put('/{id}/', [PurchaseController::class, 'update']);
    Route::delete('/{id}/', [PurchaseController::class, 'destroy']);
});

Route::prefix('/grns')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[GRNController::class, 'index']);
    Route::post('/', [GRNController::class, 'store']);
    Route::get('/{id}', [GRNController::class, 'show']);
    Route::put('/{id}/', [GRNController::class, 'update']);
    Route::delete('/{id}/', [GRNController::class, 'destroy']);
});

Route::prefix('/recipes')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[RecipeController::class, 'index']);
    Route::post('/', [RecipeController::class, 'store']);
    Route::get('/{id}', [RecipeController::class, 'show']);
    Route::put('/{id}/', [RecipeController::class, 'update']);
    Route::delete('/{id}/', [RecipeController::class, 'destroy']);
});

Route::prefix('/productions')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[ProductionController::class, 'index']);
    Route::post('/', [ProductionController::class, 'store']);
    Route::get('/{id}', [ProductionController::class, 'show']);
    Route::put('/{id}/', [ProductionController::class, 'update']);
    Route::delete('/{id}/', [ProductionController::class, 'destroy']);

    Route::post('/{id}/execute', [ProductionController::class, 'execute']);
});

Route::prefix('/orders')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::put('/{id}/', [OrderController::class, 'update']);
    Route::delete('/{id}/', [OrderController::class, 'destroy']);
});

Route::prefix('/wastes')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[WasteController::class, 'index']);
    Route::post('/', [WasteController::class, 'store']);
    Route::get('/{id}', [WasteController::class, 'show']);
    Route::put('/{id}/', [WasteController::class, 'update']);
    Route::delete('/{id}/', [WasteController::class, 'destroy']);
});

Route::prefix('/stock-counts')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [StockCountController::class,'index']);
    Route::post('/', [StockCountController::class, 'store']);
    Route::get('/{id}', [StockCountController::class, 'show']);
    Route::put('/{id}/', [StockCountController::class, 'update']);
    Route::delete('/{id}/', [StockCountController::class, 'destroy']);

    Route::post('/{id}/apply', [StockCountController::class, 'apply']);
});


Route::prefix('/reports')->middleware('auth:sanctum')->group(function () {
    Route::get('/inventory',[ReportController::class, 'InventoryReport']);
    Route::get('/profit',[ReportController::class, 'ProfitReport']);
    Route::get('/movement',[ReportController::class, 'MovementReport']);
    Route::get('/variance',[ReportController::class, 'VarianceReport']);
    Route::get('/daily',[ReportController::class, 'DailyReport']);
    Route::get('/top-products',[ReportController::class, 'topProducts']);
});

Route::prefix('/notifications')->middleware('auth:sanctum')->group(function () {
    Route::get('/unread', [NotificationController::class, 'unread']);
    Route::get('/count', [NotificationController::class, 'count']);
    Route::post('/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/read-all', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/{id}', [NotificationController::class, 'destroy']);
});

Route::prefix('profile')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/', [ProfileController::class, 'update']);
});