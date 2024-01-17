<?php

namespace Weather;

use Weather\Facades\Weather;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('weather', function () {
            return new Weather(config('weather.api_key'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/weather.php' => config_path('weather.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/config/weather.php', 'weather');
        
        $this->app->alias('Weather', Weather::class);
    }
}
