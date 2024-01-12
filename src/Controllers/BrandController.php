<?php

namespace Hrgweb\InventoryManagement\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Hrgweb\InventoryManagement\Domain\Brand\Data\BrandData;
use Hrgweb\InventoryManagement\Domain\Brand\Services\BrandService;

class BrandController extends Controller
{
    public function store(BrandData $supplier)
    {
        try {
            return BrandService::make($supplier->all())->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
