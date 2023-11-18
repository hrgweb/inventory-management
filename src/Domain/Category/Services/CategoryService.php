<?php

namespace Hrgweb\SalesAndInventory\Domain\Category\Services;

use App\Models\Category;
use Exception;
use Hrgweb\SalesAndInventory\Domain\Category\Data\CategoryData;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function save()
    {
        $category =  Category::create($this->request);

        if (!$category) {
            throw new Exception('no category saved. encountered an error');
        }

        Log::info('new category (' . $this->request['name'] . ') saved.');

        return CategoryData::from($category)->additional(['created_at' => $category->created_at]);
    }
}
