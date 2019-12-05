<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 2:16 PM
 */
namespace M0xy\Cms\Services;

use Illuminate\Support\Str;

class CommonObserve
{
    public static function checkSlug($entity){
        if(empty($entity->slug))
            $entity->slug = Str::slug(!empty($entity->meta_title) ? $entity->meta_title : $entity->h1);
    }
}