<?php

namespace App\Providers;

use App\CoverApi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CoverApiViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $coverApi = app(CoverApi::class);
            $view->with('coverApi', $coverApi);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
