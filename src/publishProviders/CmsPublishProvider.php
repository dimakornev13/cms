<?php


namespace App\Providers;


use App\Models\Category;
use App\Models\Page;
use App\Models\Uri;
use App\Observers\CategoryObserve;
use App\Observers\PageObserver;
use App\Observers\UriObserve;
use App\Voyager\FormFields\JsonFormField;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

class CmsPublishProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Page::observe(PageObserver::class);
        Category::observe(CategoryObserve::class);
        Uri::observe(UriObserve::class);

        Voyager::addFormField(JsonFormField::class);
    }
}
