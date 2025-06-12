<?php

namespace AlwaysOpen\OxylabsApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlwaysOpen\OxylabsApi\OxylabsApi
 */
class OxylabsApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlwaysOpen\OxylabsApi\OxylabsApi::class;
    }
}
