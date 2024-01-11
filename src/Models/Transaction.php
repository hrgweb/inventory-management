<?php

namespace Hrgweb\PosAndInventory\Models;

use Illuminate\Database\Eloquent\Model;
use Hrgweb\PosAndInventory\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
