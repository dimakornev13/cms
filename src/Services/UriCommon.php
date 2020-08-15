<?php
/**
 * Created by PhpStorm.
 * User: ema
 * Date: 11/2/19
 * Time: 4:27 PM
 */

namespace App\Services\Cms;


use App\Repositories\UriRepository;

class UriCommon
{
    private $urls;

    public function __construct(UriRepository $urls)
    {
        $this->urls = $urls;
    }

//    public function deleteByEntityId($entity)
//    {
//        $this->urls->delete((int) $entity->id, (int) $entity->type);
//    }
//
//
//    private function getType($entity)
//    {
//        $types = [
//            'page' => Uri::TYPE_PAGE,
//            'category' => Uri::TYPE_PAGES_CATEGORY,
//        ];
//
//        $type = collect(explode('\\', get_class($entity)))->last();
//        $type = strtolower($type);
//
//        return $types[$type];
//    }
}
