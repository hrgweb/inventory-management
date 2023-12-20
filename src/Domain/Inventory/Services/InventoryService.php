<?php

namespace Hrgweb\SalesAndInventory\Domain\Inventory\Services;

use Illuminate\Database\Eloquent\Builder;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;

class InventoryService
{
    public function __construct(protected array $request)
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function products(): mixed
    {
        $search = $this->request['search'] ?? '';

        return ProductData::collection(Product::query()
            ->when($search, function (Builder $query, string $search) {
                $query->whereRaw('name like ?', [$search . '%']);
            })
            ->when($search, function (Builder $query, string $search) {
                $query->whereRaw('name like ?', [$search . '%']);
            })
            ->paginate(10));
            // ->toSql());

        return Product::query()
            ->when($search, function (Builder $query, string $search) {
                $query->whereRaw('name like ?', [$search . '%']);
            })
            ->when($search, function (Builder $query, string $search) {
                $query->orWhereRaw('barcode like ?', [$search . '%']);
            })
            // ->paginate(10));
            ->toSql();
    }
}
