<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\Transaction\Data\TransactionData;
use Hrgweb\SalesAndInventory\Domain\Transaction\Services\TransactionService;

class TransactionController extends Controller
{
    public function data()
    {
        try {
            return TransactionService::make()->data();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function index()
    {
        try {
            return TransactionService::make()->fetch();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(TransactionData $transaction)
    {
        try {
            return TransactionService::make($transaction->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(TransactionData $transaction, int $id)
    {
        try {
            return TransactionService::make($transaction->toArray())->update($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function remove(int $id)
    {
        try {
            return TransactionService::make(request()->all())->remove($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
