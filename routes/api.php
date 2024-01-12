<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionSessionController;
use Hrgweb\InventoryManagement\Models\TransactionSession;
use Hrgweb\InventoryManagement\Controllers\OrderController;
use Hrgweb\InventoryManagement\Controllers\CategoryController;
use Hrgweb\InventoryManagement\Controllers\SupplierController;
use Hrgweb\InventoryManagement\Controllers\TransactionController;
use Hrgweb\InventoryManagement\Domain\Order\Services\OrderService;
use Hrgweb\InventoryManagement\Domain\Supplier\Services\SupplierService;

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
    Route::delete('/transactions/void', [TransactionController::class, 'void']);
    Route::resource('transactions', TransactionController::class);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::resource('/orders', OrderController::class);

    // Sale
    Route::post('/sales', [SaleController::class, 'store']);
});
