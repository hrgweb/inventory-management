<?php

namespace Hrgweb\InventoryManagement\Domain\Supplier\Services;

use Exception;
use Hrgweb\InventoryManagement\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Hrgweb\InventoryManagement\Domain\Supplier\Data\SupplierData;

class SupplierService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public static function all(): mixed
    {
        return Supplier::select(['id', 'name', 'description'])->get();
    }

    public static function fetch(): mixed
    {
        return SupplierData::collection(Supplier::paginate(10));
    }

    public function save()
    {
        $supplier =  Supplier::create($this->request);

        if (!$supplier) {
            throw new Exception('no supplier saved. encountered an error');
        }

        Log::info('new supplier (' . $this->request['name'] . ') saved.');

        return SupplierData::from($supplier)->additional(['created_at' => $supplier->created_at]);
    }

    public function update(int $id): bool
    {
        $update = Supplier::where('id', $id)->update([
            'name' => $this->request['name'],
            'description' => $this->request['description'],
        ]);

        if (!$update) {
            throw new Exception('no supplier updated. encountered an error.');
        }

        Log::info('supplier (' . $this->request['name'] . ') was successfuly updated.');

        return true;
    }

    public function remove(int $id) //: bool
    {
        $remove = Supplier::where('id', $id)->delete();

        if (!$remove) {
            throw new Exception('no supplier was removed. encountered an error.');
        }

        Log::info('1 supplier ' . $this->request['name'] . ' was successfuly removed.');

        return true;
    }
}
