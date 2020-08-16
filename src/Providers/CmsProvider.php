<?php

namespace M0xy\Cms\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->publishes([
            __DIR__ . '/../Console' => app_path('Console/Commands'),
            __DIR__ . '/../Middleware' => app_path('Http/Middleware'),
            __DIR__ . '/../Controllers' => app_path('Http/Controllers'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/../Models' => app_path('Models'),
            __DIR__ . '/../Observers' => app_path('Observers'),
            __DIR__ . '/../Repositories' => app_path('Repositories'),
            __DIR__ . '/../routes/web.php' => base_path('routes/cms.php'),
            __DIR__ . '/../Services' => app_path('Services/Cms'),
            __DIR__ . '/../Tests' => base_path('tests'),
            __DIR__ . '/../Voyager' => app_path('Voyager'),
            __DIR__ . '/../publishProviders' => app_path('Providers'),
        ]);

    }
}
