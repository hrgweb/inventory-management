<?php

namespace Hrgweb\SalesAndInventory\Domain\Category\Data;

use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public ?int $parent_category_id,
        public ?bool $is_active,
        public ?string $img_url,
        public ?int $display_order,
        public ?string $notes,
    ) {
        $this->parent_category_id = 0;
        $this->is_active = 1;
    }
}
