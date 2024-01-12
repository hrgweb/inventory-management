<?php

namespace Hrgweb\InventoryManagement\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\InventoryManagement\Domain\Sale\Data\SaleData;
use Hrgweb\InventoryManagement\Domain\Sale\Services\TransactionService;


class SaleController extends Controller
{
    public function store(SaleData $sale)
    {
        try {
            return TransactionService::make($sale->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
