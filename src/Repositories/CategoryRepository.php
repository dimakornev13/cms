<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    /**
     * CategoryRepository constructor.
     * @param Category $entity
     */
    public function __construct(Category $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public static function getEntity(): string
    {
        return Category::class;
    }


}
