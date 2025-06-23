<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\PushPullBatchJobResponse;
use AlwaysOpen\OxylabsApi\DTOs\PushPullJobResponse;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

class PushPullResponseTest extends BaseTest
{
    public function test_instantiation_batch()
    {
        $batch = PushPullBatchJobResponse::from($this->getFixtureJsonContent('batch_push_pull_job.json'));
        $this->assertInstanceOf(PushPullBatchJobResponse::class, $batch);
        $this->assertCount(1, $batch->queries);
    }

    public function test_instantiation_push_pull()
    {
        $batch = PushPullJobResponse::from($this->getFixtureJsonContent('push_pull_job.json'));
        $this->assertInstanceOf(PushPullJobResponse::class, $batch);
        $this->assertEquals('7342973874281147393', $batch->id);
    }
}
