<?php

namespace Hrgweb\SalesAndInventory\Domain\Inventory\Services;

use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;

class InventoryService
{
    public static function products(): mixed
    {
        return ProductData::collection(Product::paginate(10));
        // return ProductData::collection(Product::all());
    }
}
