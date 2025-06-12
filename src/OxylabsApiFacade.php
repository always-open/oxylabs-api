<?php

namespace AlwaysOpen\OxylabsApi;

use Illuminate\Support\Facades\Facade;

class OxylabsApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OxylabsApiClient::class;
    }
} 