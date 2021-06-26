<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

/**
 * Class Page
 * @package App\Models
 */
class Page extends Model
{
    use GetFields;

    protected $table = 'pages';

    protected $guarded = [];

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
