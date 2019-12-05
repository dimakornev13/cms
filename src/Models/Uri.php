<?php

namespace M0xy\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Uri extends Model
{

    protected $table = 'urls';

    protected $guarded = [];

    public $timestamps = false;

    const TYPE_PAGE = 10;
    const TYPE_PAGES_CATEGORY = 20;
    const TYPE_PRODUCT = 30;
    const TYPE_PRODUCTS_CATEGORY = 40;
}
