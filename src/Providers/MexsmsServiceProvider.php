<?php

namespace MexSms\Providers;

use Illuminate\Support\ServiceProvider;
use MexSms\MexSms;

class MexsmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mexsms', function () {
            return new MexSms();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(array(
            __DIR__.'/../../config/mexsms.php' => config_path('mexsms.php'),
        ));
    }
}
