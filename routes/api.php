<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductOrderController;
use Hrgweb\SalesAndInventory\Controllers\SaleController;
use Hrgweb\SalesAndInventory\Controllers\BrandController;
use Hrgweb\SalesAndInventory\Controllers\OrderController;
use Hrgweb\SalesAndInventory\Controllers\ProductController;
use Hrgweb\SalesAndInventory\Controllers\CategoryController;
use Hrgweb\SalesAndInventory\Controllers\SupplierController;
use Hrgweb\SalesAndInventory\Controllers\InventoryTransactionController;
use Hrgweb\SalesAndInventory\Domain\Inventory\Services\InventoryService;
use Hrgweb\SalesAndInventory\Domain\Order\Services\OrderService;
use Hrgweb\SalesAndInventory\Domain\Order\Services\OrderTransactionService;

Route::prefix('api')->group(function () {
    Route::get('/data', function () {
        $session  = OrderTransactionService::generate();

        return [
            'transaction_session' => $session,
            // 'orders' => OrderService::list($session),
        ];
    });

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);

    // Supplier
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);

    // Brand
    Route::post('/brands', [BrandController::class, 'store']);

    // Inventory Transaction
    Route::post('/inventory-transactions/', [InventoryTransactionController::class, 'store']);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);

    // Sale
    Route::post('/sales', [SaleController::class, 'store']);

    // Product Order
    Route::get('/product-orders', [ProductOrderController::class, 'viaSearchOrBarcode']);

    // Inventory
    Route::get('/inventory/products/', [InventoryController::class, 'products']);
});
