<?php

namespace LucasRuroken\LaraAdmin;

use Illuminate\Support\ServiceProvider;

class LaraAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerConfig();
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

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'admin');
    }

    private function registerConfig()
    {
        $this->publishes([
            __DIR__.'/Config/admin.php' => config_path('admin.php'),
        ], 'lara-admin');
    }

}
