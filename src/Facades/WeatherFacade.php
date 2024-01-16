<?php
namespace Weather\Facades;

use Illuminate\Support\Facades\Facade;

class WeatherFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'weather';
    }
}
