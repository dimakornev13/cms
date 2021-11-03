<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\Cms\Category\CategoryGeneratePath;
use App\Services\Cms\Category\UriService;

class CategoryObserve
{
    private $uriService;
    private $categoryGeneratePath;

    public function __construct(
        UriService $uriService,
        CategoryGeneratePath $categoryGeneratePath
    )
    {
        $this->uriService = $uriService;
        $this->categoryGeneratePath = $categoryGeneratePath;
    }

    /**
     * Handle the category "created" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function created(Category $category)
    {
        $this->categoryGeneratePath->process($category);
    }

    /**
     * @param Category $category
     */
    public function saving(Category $category)
    {
    }

    /**
     * Handle the category "updated" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function updated(Category $category)
    {
    }

    public function updating(Category $category)
    {
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $this->uriService->delete($category);
    }

    /**
     * Handle the category "restored" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
