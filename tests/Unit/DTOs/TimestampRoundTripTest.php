<?php

namespace AlwaysOpen\OxylabsApi\Tests\Unit\DTOs;

use AlwaysOpen\OxylabsApi\DTOs\Amazon\AmazonPricingResponse;
use AlwaysOpen\OxylabsApi\Tests\BaseTest;

/**
 * Result timestamps survive a serialize/hydrate round trip.
 *
 * Consumers archive `toJson()` output and hydrate it again later. Spatie serializes
 * Carbon as ISO-8601, so every `#[WithCast(DateTimeInterfaceCast::class, ...)]` format
 * list must be able to read back what the same DTO writes — otherwise a replayed
 * payload silently carries a different instant than the one captured.
 */
class TimestampRoundTripTest extends BaseTest
{
    private function pricingPayload(string $createdAt): array
    {
        return [
            'job' => [
                'id' => '7412345678901234567',
                'query' => 'B000HK1ON0',
                'status' => 'done',
                'start_page' => 1,
                'source' => 'amazon_pricing',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
            'results' => [[
                'page' => 1,
                'url' => 'https://www.amazon.com/gp/aod/ajax?asin=B000HK1ON0',
                'job_id' => '7412345678901234567',
                'is_render_forced' => false,
                'status_code' => 200,
                'parser_type' => 'amazon_pricing',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'content' => [
                    'url' => 'https://www.amazon.com/gp/aod/ajax?asin=B000HK1ON0',
                    'asin' => 'B000HK1ON0',
                    'page' => 1,
                    'title' => 'Listing title',
                    'pricing' => [],
                    'asin_in_url' => 'B000HK1ON0',
                    'review_count' => 12,
                    'parse_status_code' => 12000,
                ],
            ]],
        ];
    }

    public function test_result_created_at_survives_a_json_round_trip()
    {
        $original = AmazonPricingResponse::from($this->pricingPayload('2026-08-01 14:35:07'));

        $replayed = AmazonPricingResponse::from($original->toJson());

        $this->assertSame(
            $original->results[0]->created_at->toIso8601String(),
            $replayed->results[0]->created_at->toIso8601String(),
        );
        $this->assertSame('2026-08-01T14:35:07+00:00', $replayed->results[0]->created_at->toIso8601String());
    }

    public function test_job_created_at_survives_a_json_round_trip()
    {
        $original = AmazonPricingResponse::from($this->pricingPayload('2026-08-01 14:35:07'));

        $replayed = AmazonPricingResponse::from($original->toJson());

        $this->assertSame(
            $original->job->created_at->toIso8601String(),
            $replayed->job->created_at->toIso8601String(),
        );
    }

    /**
     * @dataProvider timestampFormatProvider
     */
    public function test_supported_timestamp_formats_parse_to_the_expected_instant(string $input, string $expected)
    {
        $response = AmazonPricingResponse::from($this->pricingPayload($input));

        $this->assertSame($expected, $response->results[0]->created_at->toIso8601String());
    }

    public static function timestampFormatProvider(): array
    {
        return [
            'api datetime' => ['2026-08-01 14:35:07', '2026-08-01T14:35:07+00:00'],
            'iso8601 utc offset' => ['2026-08-01T14:35:07+00:00', '2026-08-01T14:35:07+00:00'],
            'iso8601 zulu' => ['2026-08-01T14:35:07Z', '2026-08-01T14:35:07+00:00'],
            'iso8601 negative offset' => ['2026-08-01T10:35:07-04:00', '2026-08-01T10:35:07-04:00'],
        ];
    }
}
