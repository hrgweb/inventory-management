<?php

namespace Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services;

class InventoryTransactionService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function purchase()
    {
        return ProductService::make($this->request)->save();
    }

    public function sale()
    {
        return 'about to sale';
    }

    public function adjustments()
    {
        return 'about to adjust';
    }
}
