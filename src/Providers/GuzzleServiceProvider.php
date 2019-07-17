<?php

namespace Sanchescom\Guzzle\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Sanchescom\Guzzle\Facades\Guzzle;

class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('guzzle', function () {
            return new Client(Guzzle::getDefaultConfig());
        });
    }
}
