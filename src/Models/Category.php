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


    public function uri()
    {
        return $this->hasOne(Uri::class, 'entity_id', 'id')
            ->where('type', Uri::TYPE_PAGES_CATEGORY);
    }
}
