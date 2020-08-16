<?php


namespace App\Repositories;


use App\Models\Uri;

class UriRepository extends CommonRepository
{
    /**
     * UriRepository constructor.
     * @param Uri $entity
     */
    public function __construct(Uri $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param string $uri
     * @return bool
     */
    public function exists(string $uri): bool
    {
        return $this->entity->where('uri', $uri)->exists();
    }

    /**
     * @param int $id
     */
    public function deleteCategory(int $id)
    {
        $this->entity->where([
            ['entity_id', '=', $id],
            ['type', '=', Uri::TYPE_PAGES_CATEGORY]
        ])->delete();
    }

    /**
     * @param int $id
     */
    public function deletePage(int $id)
    {
        $this->entity->where([
            ['entity_id', '=', $id],
            ['type', '=', Uri::TYPE_PAGE]
        ])->delete();
    }

//    /**
//     * @param int $id
//     * @param int $type
//     */
//    public function delete(int $id, int $type)
//    {
//        $this->entity->where([
//            ['entity_id', '=', $id],
//            ['type', '=', $type]
//        ])->delete();
//    }
}
