<?php

namespace Hrgweb\InventoryManagement\Providers;

use Illuminate\Support\ServiceProvider;

class InventoryManagementProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Configurations
        $this->publishes([
            __DIR__ . '/../../config/pos_and_inventory.php' => config_path('pos_and_inventory.php')
        ]);
    }
}
