<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\Sale\Services\TransactionService;
use Hrgweb\SalesAndInventory\Domain\Transaction\Data\TransactionData;

class TransactionController extends Controller
{
    public function store(TransactionData $transaction)
    {
        dd($transaction);

        try {
            return TransactionService::make($transaction->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
