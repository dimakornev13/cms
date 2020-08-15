<?php

namespace App\Services\Cms;

use Illuminate\Support\Str;

class CommonObserve
{

    public function checkSlug($entity)
    {
        if (empty($entity->slug))
            $entity->slug = Str::slug(!empty($entity->meta_title) ? $entity->meta_title : $entity->h1);
    }

}
