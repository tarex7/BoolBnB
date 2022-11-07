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

        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '88shqs3gnqq3267x',
                    'publicKey' => 'chx64dqbh5chqs4g',
                    'privateKey' => 'e67dcb8830150e0a751faaeacfe8d250',

                ]
            );
        });
    }
}
