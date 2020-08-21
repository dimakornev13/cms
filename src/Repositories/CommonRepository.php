<?php


namespace App\Repositories;


class CommonRepository
{
    protected $entity;

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->entity->findOrFail((int)$id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->entity->create($data);
    }

    /**
     * @return object
     */
    public function getEntity(): object
    {
        return $this->entity;
    }
}
