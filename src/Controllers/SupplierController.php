<?php

namespace Hrgweb\SalesAndInventory\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\SalesAndInventory\Domain\Supplier\Data\SupplierData;
use Hrgweb\SalesAndInventory\Domain\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            return SupplierService::make()->fetch();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(SupplierData $supplier)
    {
        try {
            return SupplierService::make($supplier->all())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(SupplierData $data, int $id)
    {
        try {
            return SupplierService::make($data->toArray())->update($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            return SupplierService::make(request()->all())->remove($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
