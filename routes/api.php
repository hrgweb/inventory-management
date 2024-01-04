<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionSessionController;
use Hrgweb\SalesAndInventory\Models\TransactionSession;
use Hrgweb\SalesAndInventory\Controllers\OrderController;
use Hrgweb\SalesAndInventory\Controllers\CategoryController;
use Hrgweb\SalesAndInventory\Controllers\SupplierController;
use Hrgweb\SalesAndInventory\Controllers\TransactionController;
use Hrgweb\SalesAndInventory\Domain\Order\Services\OrderService;
use Hrgweb\SalesAndInventory\Domain\Supplier\Services\SupplierService;

Route::prefix('api')->group(function () {
    Route::get('/data', function (Request $request) {
        $transactionSessionNo = $request->input('transaction_session_no');

        return [
            'transaction_session' => TransactionSession::select(['session_no', 'status', 'grand_total', 'amount', 'change', 'created_at'])->where('session_no', $transactionSessionNo)->first(),
            'orders' => OrderService::fetch($transactionSessionNo),
            'suppliers' => SupplierService::all()
        ];
    });

    // Transaction Session
    Route::post('/transaction-sessions', [TransactionSessionController::class, 'store']);

    // Product
    Route::get('/products/lookup', [ProductController::class, 'lookup']);
    Route::resource('products', ProductController::class);

    // Supplier
    Route::resource('suppliers', SupplierController::class);

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);

    // Transaction
    Route::get('/transactions/data', [TransactionController::class, 'data']);
    Route::resource('transactions', TransactionController::class);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::resource('/orders', OrderController::class);

    // Sale
    Route::post('/sales', [SaleController::class, 'store']);
});
