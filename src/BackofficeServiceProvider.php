<?php

namespace LucasRuroken\Backoffice;

use Illuminate\Support\ServiceProvider;
use LucasRuroken\Backoffice\Constants\ViewConstants;

class BackofficeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', ViewConstants::BACKOFFICE);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
