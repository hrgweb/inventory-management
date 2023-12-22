<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionSessionController;
use Hrgweb\SalesAndInventory\Controllers\OrderController;
use Hrgweb\SalesAndInventory\Controllers\CategoryController;
use Hrgweb\SalesAndInventory\Controllers\SupplierController;
use Hrgweb\SalesAndInventory\Controllers\TransactionController;
use Hrgweb\SalesAndInventory\Domain\Supplier\Services\SupplierService;
use Hrgweb\SalesAndInventory\Domain\TransactionSession\Services\TransactionSessionService;

Route::prefix('api')->group(function () {
    Route::get('/data', function () {
        $session  = TransactionSessionService::new();

        return [
            'transaction_session' => $session,
            'orders' => [], // OrderService::list($session),
            'suppliers' => SupplierService::all()
        ];
    });

    // Transaction Session
    Route::get('/transaction-sessions/create', [TransactionSessionController::class, 'create']);

    // Product
    Route::get('/products/', [ProductController::class, 'index']);
    Route::post('/products/', [ProductController::class, 'store']);

    // Supplier
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);

    // Transaction
    Route::post('/transactions', [TransactionController::class, 'store']);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);

    // Sale
    Route::post('/sales', [SaleController::class, 'store']);
});
