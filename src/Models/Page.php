<?php

namespace M0xy\Cms\Models;

use App\Model\Ticket;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

class Page extends Model
{

    protected $table = 'pages';

    protected $guarded = [];

    protected $casts = [
        'parameters' => 'object'
    ];


    public function setParametersAttribute($value)
    {
        if (!is_string($value))
            $value = Json::encode($value);

        $this->attributes['parameters'] = preg_replace('#\s{2,}#', ' ', $value);
    }


    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    public function uri()
    {
        return $this->hasOne(Uri::class, 'entity_id', 'id')
            ->where('type', Uri::TYPE_PAGE);
    }
}
