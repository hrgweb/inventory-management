<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Models\InventoryTransaction;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\InventoryTransactionData;

class InventoryTransactionService
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
            $product = ProductService::make($this->request)->save();

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
}
