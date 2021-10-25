<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;
use Statamic\Contracts\Assets\Asset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Asset::class, function () {
            return new \App\Asset;
        });
    }
}
