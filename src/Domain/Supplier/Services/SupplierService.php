<?php

namespace Hrgweb\SalesAndInventory\Domain\Supplier\Services;

use Exception;
use Hrgweb\SalesAndInventory\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Domain\Supplier\Data\SupplierData;

class SupplierService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function save()
    {
        $supplier =  Supplier::create($this->request);

        if (!$supplier) {
            throw new Exception('no supplier saved. encountered an error');
        }

        Log::info('new supplier (' . $this->request['name'] . ') saved.');

        return SupplierData::from($supplier)->additional(['created_at' => $supplier->created_at]);
    }
}
