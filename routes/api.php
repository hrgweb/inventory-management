<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use Hrgweb\SalesAndInventory\Controllers\SaleController;
use Hrgweb\SalesAndInventory\Controllers\OrderController;
use Hrgweb\SalesAndInventory\Controllers\SupplierController;
use Hrgweb\SalesAndInventory\Domain\Supplier\Services\SupplierService;
use Hrgweb\SalesAndInventory\Domain\Order\Services\OrderTransactionService;

Route::prefix('api')->group(function () {
    Route::get('/data', function () {
        $session  = OrderTransactionService::generate();

        return [
            'transaction_session' => $session,
            'orders' => [], // OrderService::list($session),
            'suppliers' => SupplierService::all()
        ];
    });

    // Product
    Route::get('/products/', [ProductController::class, 'index']);
    Route::post('/products/', [ProductController::class, 'store']);

    // Supplier
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);

    // Brand
    // Route::post('/brands', [BrandController::class, 'store']);

    // Transaction
    Route::post('/transactions/', [InventoryTransactionController::class, 'store']);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);

    // Sale
    // Route::post('/sales', [SaleController::class, 'store']);

    // Order
    Route::get('/orders', [ProductOrderController::class, 'viaSearchOrBarcode']);
});
