<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services\ProductService;

class ProductController extends Controller
{
    public function show(string $productOrBarcode)
    {
        try {
            return ProductService::make()->search($productOrBarcode);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
