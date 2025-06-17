<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit;

use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class OxylabsApiServiceProviderTest extends BaseTest
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
