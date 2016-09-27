<?php

namespace LucasRuroken\LaraAdmin;

use Illuminate\Support\ServiceProvider;

class LaraAdminServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    private function registerConfig()
    {
        $this->publishes([
            __DIR__.'/Config/admin.php' => config_path('admin.php'),
        ], 'lara-admin');
    }

}
