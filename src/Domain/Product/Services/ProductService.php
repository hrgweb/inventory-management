<?php

namespace Hrgweb\SalesAndInventory\Domain\Product\Services;

use stdClass;
use Exception;
use Illuminate\Http\JsonResponse;
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

    public function update(int $id): JsonResponse
    {
        // validate the reorder level and reorder level danger
        // must less than or equal to the stock qty, else throw error message
        $stockQty = $this->request['stock_qty'];
        if (
            $this->request['reorder_level'] > $stockQty  ||
            $this->request['reorder_level_danger'] > $stockQty
        ) {
            $msg = 'Reorder level & danger must not be greater than the stock qty.';
            return response()->json([
                'errors' => [$msg],
                'message' => $msg
            ], 400);
        }

        $update = Product::where('id', $id)->update([
            'name' => $this->request['name'],
            'description' => $this->request['description'],
            'cost_price' => $this->request['cost_price'],
            'selling_price' => $this->request['selling_price'],
            'stock_qty' => $stockQty,
            'reorder_level' => $this->request['reorder_level'],
            'reorder_level_danger' => $this->request['reorder_level_danger'],
            'barcode' => $this->request['barcode'],
            'notes' => $this->request['notes']
        ]);

        if (!$update) {
            throw new Exception('no product updated. encountered an error.');
        }

        Log::info('product (' . $this->request['name'] . ') was successfuly updated.');

        return response()->json(true);
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

    public static function reduce(array $products = []): void
    {
        foreach ($products as $product) {
            $product_id = $product['productId'];

            $stock_qty = (int)Product::where('id', $product_id)->first()?->stock_qty;
            $stock_deduction = (int)$product['count'];
            $stock_left = $stock_qty - $stock_deduction;

            $updated = Product::where('id', $product_id)->update(['stock_qty' => $stock_left]);

            if (!$updated) {
                throw new Exception('product deduction encountered an error.');
            }

            info('product ' . $product['name'] . ' successfuly deducted.');
        }
    }
}
