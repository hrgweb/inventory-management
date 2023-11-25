<?php

namespace Hrgweb\SalesAndInventory\Domain\Product\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;

class InventoryData extends Data
{
    public function __construct(
        #[DataCollectionOf(ProductData::class)]
        public DataCollection $products
    ) {

    }
}