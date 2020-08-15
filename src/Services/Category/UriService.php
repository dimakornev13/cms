<?php

namespace App\Services\Cms\Category;

use App\Models\Category;
use App\Models\Uri;
use App\Repositories\CategoryRepository;
use App\Repositories\UriRepository;

class UriService
{
    private $urls;
    private $categories;


    public function __construct(UriRepository $urls, CategoryRepository $categories)
    {
        $this->urls = $urls;
        $this->categories = $categories;
    }

    public function makeUri(Category $category)
    {
        self::delete($category);

        self::getUri($category);

        try {
            $this->urls->create([
                'uri' => $category->slug,
                'entity_id' => $category->id,
                'type' => Uri::TYPE_PAGES_CATEGORY
            ]);
        } catch (\Throwable $exception) {
            $category->slug = $category->slug . '-2';
            $category->save();
        }

    }


    private function getUri(Category $category)
    {
        if ($category->parent_id > 0) {
            $parentCategory = $this->categories->findOrFail((int)$category->parent_id);
            $category->slug = $parentCategory->uri->uri . '/' . $category->slug;
        }
    }


    public function exists(Category $category)
    {
        self::getUri($category);

        return $this->urls->exists($category->slug);
    }


    public function delete(Category $category)
    {
        $this->urls->deleteCategory((int) $category->id);
    }
}
