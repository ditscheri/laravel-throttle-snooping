<?php

namespace Ditscheri\ThrottleSnooping;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ditscheri\ThrottleSnooping\ThrottleSnooping
 */
class ThrottleSnoopingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-throttle-snooping';
    }
}
