<?php


namespace App\Models;


use Psy\Util\Json;

trait GetFields
{

    public function setParametersAttribute($value)
    {
        if (!is_string($value))
            $value = Json::encode($value);

        $this->attributes['parameters'] = $value;
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

    function getParameters()
    {
        return json_decode($this->parameters);
    }
}
