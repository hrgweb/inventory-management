<?php

namespace Hrgweb\SalesAndInventory\Providers;

use Illuminate\Support\ServiceProvider;

class SalesAndInventoryProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Configurations
        $this->publishes([
            __DIR__ . '/../../config/sales_and_inventory.php' => config_path('sales_and_inventory.php')
        ]);
    }
}
