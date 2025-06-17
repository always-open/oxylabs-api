<?php

namespace AlwaysOpen\OxylabsApi\Tests;

use AlwaysOpen\OxylabsApi\OxylabsApiServiceProvider;
use Illuminate\Support\Facades\Http;
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

        Http::preventStrayRequests();
    }

    protected function getFixtureJsonContent(string $name): array
    {
        $content = $this->getFixtureContent($name);

        if ($content) {
            return json_decode($content, true);
        }

        return [];
    }

    protected function getFixtureContent(string $name): false|string
    {
        return file_get_contents(__DIR__."/Fixtures/{$name}");
    }

    protected function getPackageProviders($app)
    {
        return [
            OxylabsApiServiceProvider::class,
        ];
    }
}
