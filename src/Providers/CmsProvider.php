<?php

namespace M0xy\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;
use M0xy\Cms\Observers\CategoryObserve;
use M0xy\Cms\Observers\PageObserver;
use M0xy\Cms\Observers\UriObserve;
use M0xy\Cms\Voyager\FormFields\JsonFormField;
use TCG\Voyager\Facades\Voyager;

class CmsProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Page::observe(PageObserver::class);
        Category::observe(CategoryObserve::class);
        Uri::observe(UriObserve::class);

        Voyager::addFormField(JsonFormField::class);
    }
}
