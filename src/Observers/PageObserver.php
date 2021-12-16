<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Str;

class PageObserver
{

    /**
     * Handle the page "created" event.
     * @param Page $page
     */
    public function created(Page $page)
    {
    }


    public function saving(Page $page)
    {
        $this->checkSlug($page);
        $this->generateHierarchy($page);
    }


    /**
     * Handle the page "updated" event.
     * @param Page $page
     * @return void
     */
    public function updated(Page $page)
    {
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

    private function checkSlug($entity)
    {
        if (empty($entity->slug))
            $entity->slug = Str::slug(!empty($entity->meta_title) ? $entity->meta_title : $entity->h1);
    }

    private function generateHierarchy(Page $page)
    {
        if ($page->getOriginal('slug') == $page->getSlug() && $page->getParentId() == 0)
            return;

        $parent = $page->parent;

        $page->url = $parent
            ? "{$parent->getUrl()}/{$page->getSlug()}"
            : $page->getSlug();

        $page->path = $parent
            ? ",{$parent->getPath()}{$page->getId()},"
            : ",{$page->getId()},";

        $page->level = count(explode('/', $page->getUrl())) + 1;

        // todo handle when parent's slug|path has been changed

    }
}
