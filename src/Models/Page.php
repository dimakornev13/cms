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
    protected $table = 'pages';

    protected $guarded = [];

    protected $casts = [
        'parameters' => 'object'
    ];

    function getId()
    {
        return $this->id;
    }

    function getMetaTitle()
    {
        return $this->meta_title;
    }

    function getMetaDescription()
    {
        return $this->meta_description;
    }

    function getH1()
    {
        return $this->h1;
    }

    function getContent()
    {
        return $this->content;
    }

    function getSlug()
    {
        return $this->slug;
    }

    function getParentId()
    {
        return $this->parent_id;
    }

    function getPath()
    {
        return $this->path;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    function getUrl()
    {
        return $this->url;
    }
}
