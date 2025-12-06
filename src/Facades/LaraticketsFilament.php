<?php

namespace AichaDigital\LaraticketsFilament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AichaDigital\LaraticketsFilament\LaraticketsFilament
 */
class LaraticketsFilament extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AichaDigital\LaraticketsFilament\LaraticketsFilament::class;
    }
}
