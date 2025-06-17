<?php

namespace AlwaysOpen\OxylabsApi\Tests;

use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('vendor:publish', [
            '--provider' => OxylabsApiServiceProvider::class,
            '--tag' => 'config',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            OxylabsApiServiceProvider::class,
        ];
    }
}
