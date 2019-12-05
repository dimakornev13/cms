<?php

namespace M0xy\Cms\Observers;


use M0xy\Cms\Models\Uri;
use M0xy\Cms\Services\UriCommon;

class UriObserve
{
    /**
     * Handle the uri "created" event.
     *
     * @param  \App\Models\Uri  $uri
     * @return void
     */
    public function created(Uri $uri)
    {
        //
    }

    public function saving(Uri $uri){
        UriCommon::deleteByEntityId($uri);
    }

    /**
     * Handle the uri "updated" event.
     *
     * @param  \App\Models\Uri  $uri
     * @return void
     */
    public function updated(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "deleted" event.
     *
     * @param  \App\Models\Uri  $uri
     * @return void
     */
    public function deleted(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "restored" event.
     *
     * @param  \App\Models\Uri  $uri
     * @return void
     */
    public function restored(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "force deleted" event.
     *
     * @param  \App\Models\Uri  $uri
     * @return void
     */
    public function forceDeleted(Uri $uri)
    {
        //
    }
}
