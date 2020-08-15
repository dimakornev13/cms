<?php

namespace App\Services\Cms\Category;


use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryGeneratePath
{
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function process(Category $category)
    {
        if (!$category->exists)
            return;

        try {
            $parent = $this->categories->findOrFail((int)$category->parent_id);

            $category->path = sprintf('%s%s,', $parent->path, $category->id);
            $category->level = $parent->level + 1;
        } catch (\Exception $exception) {
            $category->path = sprintf(',%s,', $category->id);
            $category->level = 1;
        }
    }

}
