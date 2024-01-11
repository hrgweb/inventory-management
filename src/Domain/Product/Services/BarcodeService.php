<?php

namespace Hrgweb\PosAndInventory\Domain\Product\Services;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Hrgweb\PosAndInventory\Domain\Product\Class\Directory;

class BarcodeService
{
    public static function create()
    {
        // If you want to use rand instead of mt_rand, you can do this:
        // $randomNumber = str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT);

        return str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
    }

    public static function generate($name = '', $barcode = '')
    {
        $generator = new BarcodeGeneratorPNG();

        $filename =  $name . '-' . time() . '.png';
        $filepath = storage_path('app/public/barcode/') . $filename;

        // Generate barcode dir on storage/app/public
        Directory::create();

        file_put_contents($filepath, $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 3, 50));
    }
}
