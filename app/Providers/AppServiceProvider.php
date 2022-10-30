<?php

namespace App\Providers;

use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

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
        $this->app->singleton(Gateway::class,function($app){
            return new Gateway(
            [
                'environment'=>'sandbox',
                'merchantId'=> "zpkjh2mc8b8gcwbc",
                'publicKey'=> "nm9hh4r8772tktp3",
                'privateKey'=> "4dad9ac2bc26b8a654999e042d9ef32d",
            ]
            );
        });
       
        // AppServiceProvider.php
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('it_IT');
        });

    }
}
