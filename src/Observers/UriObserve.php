<?php

namespace App\Observers;


use App\Models\Uri;

class UriObserve
{
    /**
     * Handle the uri "created" event.
     *
     * @param \App\Models\Uri $uri
     * @return void
     */
    public function created(Uri $uri)
    {
        //
    }


    public function saving(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "updated" event.
     *
     * @param \App\Models\Uri $uri
     * @return void
     */
    public function updated(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "deleted" event.
     *
     * @param \App\Models\Uri $uri
     * @return void
     */
    public function deleted(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "restored" event.
     *
     * @param \App\Models\Uri $uri
     * @return void
     */
    public function restored(Uri $uri)
    {
        //
    }

    /**
     * Handle the uri "force deleted" event.
     *
     * @param \App\Models\Uri $uri
     * @return void
     */
    public function forceDeleted(Uri $uri)
    {
        //
    }
}
