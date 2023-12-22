<?php

namespace Hrgweb\SalesAndInventory\Domain\Transaction\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Hrgweb\SalesAndInventory\Models\Product;
use Hrgweb\SalesAndInventory\Models\Transaction;
use Hrgweb\SalesAndInventory\Domain\Product\Data\ProductData;
use Hrgweb\SalesAndInventory\Domain\Product\Services\BarcodeService;
use Hrgweb\SalesAndInventory\Domain\Product\Services\ProductService;
use Hrgweb\SalesAndInventory\Domain\Transaction\Data\TransactionData;
use Hrgweb\SalesAndInventory\Domain\Transaction\Enums\TransactionType;

class TransactionService
{
    public function __construct(protected array $request)
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    private function purchase()
    {
        // $this->request['product']['barcode'] = BarcodeService::create();

        $product = new Product;
        $transaction = new Transaction;

        DB::beginTransaction();
        try {
            $product = ProductService::make($this->request['product'])->save();

            $transaction = Transaction::create(array_merge($this->request, ['product_id' => $product->id]));

            if (!$transaction) {
                throw new Exception('no inventory transaction saved. encountered an error');
            }

            Log::info('1 inventory transaction saved.');
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
        DB::commit();

        // generate barcode img
        // BarcodeService::generate($product->name, $product->barcode);

        return TransactionData::from(array_merge($transaction->toArray(), ['product' => ProductData::from($product)]))->additional(['created_at' => $transaction->created_at]);
    }

    public function save()
    {
        $transaction_type = $this->request['transaction_type'] ??= TransactionType::PURCHASE;

        return match ($transaction_type) {
            TransactionType::PURCHASE->value => $this->purchase(),
            TransactionType::SALE->value => 'sale',
            TransactionType::ADJUSTMENTS->value => 'adjustment'
        };
    }
}
