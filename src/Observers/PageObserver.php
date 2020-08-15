<?php

namespace App\Observers;


use App\Models\Page;
use App\Services\Cms\CommonObserve;
use App\Services\Cms\Page\UriService;

class PageObserver
{
    private $uriService;
    private $commonObserve;

    public function __construct(UriService $uriService, CommonObserve $commonObserve)
    {
        $this->uriService = $uriService;
        $this->commonObserve = $commonObserve;
    }

    /**
     * Handle the page "created" event.
     * @param Page $page
     */
    public function created(Page $page)
    {
        $this->uriService->makeUri($page);
    }


    public function saving(Page $page)
    {
        $this->commonObserve->checkSlug($page);
    }


    /**
     * Handle the page "updated" event.
     * @param Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        $this->uriService->makeUri($page);
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
        $this->uriService->delete($page);
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
