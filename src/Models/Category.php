<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    use GetFields;

    protected $table = 'categories';

    protected $guarded = [];


    /**
     * Get Pages via pivot table for this category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    /**
     * Get Uri Model assciated with this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function uri()
    {
        return $this->hasOne(Uri::class, 'entity_id', 'id')
            ->where('type', Uri::TYPE_PAGES_CATEGORY);
    }
}
