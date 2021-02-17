<?php

namespace App\Providers;

use App\Models\Itinerary;
use Cristal\ApiWrapper\Transports\Bearer;
use Illuminate\Support\ServiceProvider;
use OAuth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
