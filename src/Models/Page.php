<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

/**
 * Class Page
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $h1
 * @property string $content
 * @property string $slug
 * @property object $parameters
 * @package App\Models
 */
class Page extends Model
{

    protected $table = 'pages';

    protected $guarded = [];

    protected $casts = [
        'parameters' => 'object'
    ];


    /**
     * @param $value
     */
    public function setParametersAttribute($value)
    {
        if (!is_string($value))
            $value = Json::encode($value);

        $this->attributes['parameters'] = preg_replace('#\s{2,}#', ' ', $value);
    }


    /**
     * Get main Category for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * Get Uri Model associated with this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function uri()
    {
        return $this->hasOne(Uri::class, 'entity_id', 'id')
            ->where('type', Uri::TYPE_PAGE);
    }
}
