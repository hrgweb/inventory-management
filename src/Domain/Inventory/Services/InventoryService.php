<?php

namespace Hrgweb\SalesAndInventory\Domain\Inventory\Services;

use Spatie\LaravelData\DataCollection;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;

class InventoryService
{
    public static function products(): mixed
    {
        return ProductData::collection(Product::paginate(10));
    }
}
