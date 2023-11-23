<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Data\InventoryTransactionData;
use Hrgweb\SalesAndInventory\Domain\InventoryTransaction\Services\InventoryTransactionService;

class InventoryTransactionController extends Controller
{
    public function store(InventoryTransactionData $inventoryTransaction)
    {
        try {
            return InventoryTransactionService::make($inventoryTransaction->toArray())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
