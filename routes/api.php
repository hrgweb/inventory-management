<?php

use Illuminate\Support\Facades\Route;
use Hrgweb\SalesAndInventory\Controllers\SaleController;
use Hrgweb\SalesAndInventory\Controllers\BrandController;
use Hrgweb\SalesAndInventory\Controllers\OrderController;
use Hrgweb\SalesAndInventory\Controllers\ProductController;
use Hrgweb\SalesAndInventory\Controllers\CategoryController;
use Hrgweb\SalesAndInventory\Controllers\SupplierController;
use Hrgweb\SalesAndInventory\Controllers\InventoryTransactionController;

Route::prefix('api')->group(function () {
    // Category
    Route::post('/categories', [CategoryController::class, 'store']);

    // Supplier
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

    // Product
    Route::get('/products/{productOrBarcode}', [ProductController::class, 'show']);
});
