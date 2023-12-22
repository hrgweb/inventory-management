<?php

namespace Hrgweb\SalesAndInventory\Domain\Product\Class;

class Directory
{
    public static function create($path = 'app/public/barcode'): void
    {
        $path = storage_path($path);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);

            info('barcode directory created.');
        }
    }
}
