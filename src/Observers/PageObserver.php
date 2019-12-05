<?php

namespace M0xy\Cms\Observers;


use M0xy\Cms\Models\Page;
use M0xy\Cms\Services\CommonObserve;
use M0xy\Cms\Services\Page\UriService;

class PageObserver
{

    /**
     * Handle the page "created" event.
     * @param Page $page
     */
    public function created(Page $page)
    {
        UriService::makeUri($page);
    }


    public function saving(Page $page)
    {
        CommonObserve::checkSlug($page);

    }


    /**
     * Handle the page "updated" event.
     * @param Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        UriService::makeUri($page);
    }


    /**
     * Handle the page "deleted" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function deleted(Page $page)
    {
        UriService::delete($page);
    }


    /**
     * Handle the page "restored" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }


    /**
     * Handle the page "force deleted" event.
     *
     * @param Page $page
     *
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
