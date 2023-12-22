<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
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


    public function fetch(): mixed
    {
        $search = $this->request['search'] ?? '';

        return ProductData::collection(Product::query()
            ->when($search, function (Builder $query, string $search) {
                $query->whereRaw('name like ?', [$search . '%']);
            })
            ->when($search, function (Builder $query, string $search) {
                $query->orWhereRaw('barcode like ?', [$search . '%']);
            })
            ->latest('created_at')
            ->paginate(10));
    }
}
