<?php

namespace Hrgweb\SalesAndInventory\Domain\Brand\Services;

use Exception;
use Hrgweb\SalesAndInventory\Models\Brand;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Domain\Brand\Data\BrandData;

class BrandService
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
        $Brand =  Brand::create($this->request);

        if (!$Brand) {
            throw new Exception('no Brand saved. encountered an error');
        }

        Log::info('new Brand (' . $this->request['name'] . ') saved.');

        return BrandData::from($Brand)->additional(['created_at' => $Brand->created_at]);
    }
}
