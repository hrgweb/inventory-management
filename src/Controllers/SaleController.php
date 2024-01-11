<?php

namespace Hrgweb\PosAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\PosAndInventory\Domain\Sale\Data\SaleData;
use Hrgweb\PosAndInventory\Domain\Sale\Services\TransactionService;


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
