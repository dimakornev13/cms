<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 4:27 PM
 */

namespace M0xy\Cms\Services;

use M0xy\Cms\Models\Uri;

class UriCommon
{
    public static function deleteByEntityId($entity){
        Uri::where([
            ['entity_id', '=', $entity->id],
            ['type', '=', $entity->type]
        ])->delete();
    }


    private static function getType($entity){
        $types = [
            'page' => Uri::TYPE_PAGE,
            'category' => Uri::TYPE_PAGES_CATEGORY,
            'product' => Uri::TYPE_PRODUCT,
        ];

        $type = collect(explode('\\', get_class($entity)))->last();
        $type = strtolower($type);

        return $types[$type];
    }
}