<?php

namespace Hrgweb\SalesAndInventory\Providers;

use Illuminate\Support\ServiceProvider;

class SalesAndInventoryProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
