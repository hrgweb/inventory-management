<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services\ProductService;

class ProductController extends Controller
{
    public function show(string $productOrBarcode)
    {
        try {
            $product = ProductService::make()->search($productOrBarcode);

            if (!$product) {
                return ProductData::empty();
            }

            //
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
