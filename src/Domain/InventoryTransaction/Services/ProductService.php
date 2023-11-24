<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;

class ProductService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function save(): ProductData
    {
        $product = Product::create($this->request['product']);

        if (!$product) {
            throw new Exception('no product saved. encountered an error.');
        }

        Log::info('new product (' . $product->name . ') saved.');

        return ProductData::from($product);
    }


    public function search(string $productOrBarcode): ProductData
    {
        $product = Product::whereRaw('name like ?', [$productOrBarcode . '%'])
            ->orWhereRaw('barcode like ?', [$productOrBarcode])
            ->first();

        if (!$product) {
            throw new Exception('no product found base on product name or barcode.');
        }

        return ProductData::from($product);
    }
}
