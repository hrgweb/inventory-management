<?php

namespace Hrgweb\SalesAndInventory\Domain\Product\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        // public ?int $category_id,
        // public ?int $brand_id,
        // public ?int $supplier_id,
        public float $cost_price,
        public float $selling_price,
        public int $stock_qty,
        public int $reorder_level,
        public ?string $barcode,
        // public ?float $tax_rate,
        // public ?float $discount,
        public ?bool $is_available,
        // public ?string $product_image_url,
        // public ?float $weight,
        // public ?string $dimensions,
        public ?string $notes,
    ) {
        // $this->category_id = 1;
        // $this->brand_id = 1;
        // $this->supplier_id = 1;
        $this->is_available = true;
    }
}
