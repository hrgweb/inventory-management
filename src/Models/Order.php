<?php

namespace Hrgweb\InventoryManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Hrgweb\InventoryManagement\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
