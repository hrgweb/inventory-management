<?php

namespace Hrgweb\SalesAndInventory\Domain\Product\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Domain\Product\Data\ProductData;

class ProductService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
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

    public function lookup(): mixed
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
            ->get());
    }

    public function save(): ProductData
    {
        $product = Product::create($this->request);

        if (!$product) {
            throw new Exception('no product saved. encountered an error.');
        }

        Log::info('new product (' . $product->name . ') saved.');

        return ProductData::from($product);
    }

    public function update(int $id): bool
    {
        $update = Product::where('id', $id)->update([
            'name' => $this->request['name'],
            'description' => $this->request['description'],
            'selling_price' => $this->request['selling_price'],
            'stock_qty' => $this->request['stock_qty'],
            'reorder_level' => $this->request['reorder_level'],
            'barcode' => $this->request['barcode'],
            'notes' => $this->request['notes']
        ]);

        if (!$update) {
            throw new Exception('no product updated. encountered an error.');
        }

        Log::info('product (' . $this->request['name'] . ') was successfuly updated.');

        return true;
    }

    public function remove(int $id) //: bool
    {
        $remove = Product::where('id', $id)->delete();

        if (!$remove) {
            throw new Exception('no product was removed. encountered an error.');
        }

        Log::info('1 product ' . $this->request['name'] . ' was successfuly removed.');

        return true;
    }
}
