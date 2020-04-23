<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 2:35 PM
 */

namespace M0xy\Cms\Services\Category;


use M0xy\Cms\Models\Category;

class CategoryGeneratePath
{

    public static function process(Category $category)
    {
        if (!$category->exists)
            return;

        try {
            $parent = Category::findOrFail($category->parent_id);

            $category->path = sprintf('%s%s,', $parent->path, $category->id);
            $category->level = $parent->level + 1;
        } catch (\Exception $exception) {
            $category->path = sprintf(',%s,', $category->id);
            $category->level = 1;
        }
    }

}
