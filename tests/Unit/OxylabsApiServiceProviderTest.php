<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit;

use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Orchestra\Testbench\TestCase;

class OxylabsApiServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [OxylabsApiServiceProvider::class];
    }

    public function test_service_provider_publishes_config()
    {
        $this->artisan('vendor:publish', [
            '--provider' => OxylabsApiServiceProvider::class,
            '--tag' => 'config',
        ]);

        $this->assertFileExists(config_path('oxylabs-api.php'));
    }
}
