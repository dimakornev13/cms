<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uri extends Model
{
    const TYPE_PAGE = 10;

    const TYPE_PAGES_CATEGORY = 20;

    protected $table = 'urls';

    protected $guarded = [];

    public $timestamps = false;


    public function getRouteKeyName()
    {
        return 'uri';
    }
}
