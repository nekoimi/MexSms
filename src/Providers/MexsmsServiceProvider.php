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
            __DIR__.'/../../config/mexsms.php' => $this->getConfigPath('mexsms.php'),
        ));
    }

    /**
     *
     * @param string|null $file_name
     * @return string
     */
    protected function getConfigPath(string $file_name = null) {
        if (is_null($file_name)) {
            return $this->app->basePath() . '/config';
        }
        return $this->app->basePath() . '/config/' . ltrim($file_name, '/');
    }

}
