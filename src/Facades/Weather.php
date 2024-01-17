<?php
namespace Weather\Facades;

use Illuminate\Support\Facades\Facade;

class Weather extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'weather';
    }
}
