<?php

namespace M0xy\Cms\Observers;

use M0xy\Cms\Models\Category;
use M0xy\Cms\Services\Category\CategoryGeneratePath;
use M0xy\Cms\Services\Category\UriService;
use M0xy\Cms\Services\CommonObserve;

class CategoryObserve
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        // fire updating for path generating
        $category->save();
    }

    public function saving(Category $category){
        CommonObserve::checkSlug($category);

        //if(UriService::exists($category))
        //    return false;
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        UriService::makeUri($category);
    }

    public function updating(Category $category){
        CategoryGeneratePath::process($category);
    }
    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        UriService::delete($category);
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
