<?php

namespace M0xy\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

class Category extends Model
{

    protected $table = 'categories';

    protected $guarded = [];


    public function setParametersAttribute($value)
    {
        if (!is_string($value))
            $value = Json::encode($value);

        $this->attributes['parameters'] = $value;
    }


    /**
     * Get Pages via pivot table for this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages(){
        return $this->hasMany(Page::class);
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
