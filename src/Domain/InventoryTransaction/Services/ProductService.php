<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services;

use Exception;
use Hrgweb\SalesAndInventory\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\InventoryTransaction;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Class\Directory;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\InventoryTransactionData;

class ProductService
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
        $this->request['product']['barcode'] = BarcodeService::create();

        $product = new Product;
        $inventoryTransaction = new InventoryTransaction;

        DB::beginTransaction();
        try {
            // save purchase product
            $product = Product::create($this->request['product']);

            if (!$product) {
                throw new Exception('no product saved. encountered an error.');
            }

            Log::info('new product (' . $product->name . ') saved.');

            // save inventory transaction
            $inventoryTransaction = InventoryTransaction::create(array_merge($this->request, ['product_id' => $product->id]));

            if (!$inventoryTransaction) {
                throw new Exception('no inventory transaction saved. encountered an error');
            }

            Log::info('1 inventory transaction saved.');
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
        DB::commit();

        // generate barcode img
        BarcodeService::generate($product->name, $product->barcode);

        return InventoryTransactionData::from(array_merge($inventoryTransaction->toArray(), ['product' => ProductData::from($product)]))->additional(['created_at' => $inventoryTransaction->created_at]);
    }

    public function search(string $productOrBarcode): array
    {
        $result = Product::whereRaw('name like ?', [$productOrBarcode . '%'])
            ->orWhereRaw('barcode like ?', [$productOrBarcode])
            ->first();

        if (!$result) {
            return ProductData::empty();
        }

        return ProductData::from($result)->toArray();
    }
}
