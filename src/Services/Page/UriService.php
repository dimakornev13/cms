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

    /**
     * Generate Uri for page and save it
     *
     * @param Page $page
     */
    public static function makeUri(Page $page)
    {
        static::delete($page);

        try {
            Uri::create([
                'uri' => static::getUri($page),
                'entity_id' => $page->id,
                'type' => Uri::TYPE_PAGE
            ]);
        } catch (\Throwable $exception) {
            $page->slug = $page->slug . '-2';
            $page->save();
        }
    }


    /**
     * Return Uri for page
     *
     * @param Page $page
     *
     * @return string
     */
    private static function getUri(Page $page): string
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
