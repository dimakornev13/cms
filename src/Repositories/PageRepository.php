<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends CommonRepository
{
    /**
     * PageRepository constructor.
     * @param Page $entity
     */
    public function __construct(Page $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public static function getEntity(): string
    {
        return Page::class;
    }

    /**
     * @return Page
     */
    public function getIndexPage(): Page
    {
        return $this->entity->where('slug', '/')->firstOrFail();
    }
}
