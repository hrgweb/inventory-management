<?php

namespace Hrgweb\InventoryManagement\Domain\Brand\Data;

use Spatie\LaravelData\Data;

class BrandData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public ?string $country_of_origin,
        public ?int $founded_year,
        public ?string $website,
        public ?string $contact_email,
        public ?string $contact_phone,
        public ?string $logo_url,
        public ?bool $is_active,
        public ?string $notes,
    ) {
        $this->is_active = true;
    }
}
