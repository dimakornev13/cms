<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 4:26 PM
 */

namespace M0xy\Cms\Services\Page;

use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;

class UriService
{

    public static function makeUri(Page $page)
    {
        static::delete($page);

        try {
            Uri::create([
                'uri' => self::getUri($page),
                'entity_id' => $page->id,
                'type' => Uri::TYPE_PAGE
            ]);
        } catch (\Throwable $exception) {
            $page->slug = $page->slug . '-2';
            $page->save();
        }
    }


    private static function getUri(Page $page)
    {
        return $page->category_id > 0
            ? $page->category->uri->uri . '/' . $page->slug
            : $page->slug;
    }


    public static function exists(Page $page)
    {
        return Uri::where('uri', self::getUri($page))->exists();
    }


    public static function delete(Page $page)
    {
        Uri::where([
            ['entity_id', '=', $page->id],
            ['type', '=', Uri::TYPE_PAGE]
        ])->delete();
    }
}