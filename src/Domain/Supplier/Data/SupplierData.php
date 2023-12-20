<?php

namespace Hrgweb\SalesAndInventory\Domain\Supplier\Data;

use Spatie\LaravelData\Data;

class SupplierData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public ?string $contact_person,
        public ?string $contact_title,
        public ?string $address,
        public ?string $city,
        public ?string $region,
        public ?string $country,
        public ?string $postal_code,
        public ?string $email,
        public ?string $phone,
        public ?string $fax,
        public ?string $website,
        public ?bool $is_active,
        public ?string $notes,
    ) {
        $this->is_active = true;
    }
}
