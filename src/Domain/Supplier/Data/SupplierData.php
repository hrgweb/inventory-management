<?php

namespace Hrgweb\InventoryManagement\Domain\Supplier\Data;

use Spatie\LaravelData\Data;

class SupplierData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
    ) {
    }
}
