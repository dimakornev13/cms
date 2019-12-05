<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 5:06 PM
 */

namespace M0xy\Cms\Services\Category;


use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Uri;

class UriService
{

    public static function makeUri(Category $category)
    {
        self::delete($category);

        self::getUri($category);

        try {
            Uri::create([
                'uri' => $category->slug,
                'entity_id' => $category->id,
                'type' => Uri::TYPE_PAGES_CATEGORY
            ]);
        } catch (\Throwable $exception) {
            $category->slug = $category->slug . '-2';
            $category->save();
        }

    }


    private static function getUri(Category $category)
    {
        if ($category->parent_id > 0) {
            $parentCategory = Category::find($category->parent_id);
            $category->slug = $parentCategory->uri->uri . '/' . $category->slug;
        }
    }


    public static function exists(Category $category)
    {
        self::getUri($category);

        return Uri::where('uri', $category->slug)->exists();
    }


    public static function delete(Category $category)
    {
        Uri::where([
            ['entity_id', '=', $category->id],
            ['type', '=', Uri::TYPE_PAGES_CATEGORY]
        ])->delete();
    }
}