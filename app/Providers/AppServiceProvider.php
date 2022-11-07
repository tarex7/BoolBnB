<?php

namespace App\Providers;

use Braintree\Gateway;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\ServiceProvider;

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
        // AppServiceProvider.php
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('it_IT');
        });

        
    }
}