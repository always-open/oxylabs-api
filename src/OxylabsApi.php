<?php

namespace AlwaysOpen\OxylabsApi;

use Illuminate\Support\Arr;

class OxylabsApi
{
    /*
     * https://developers.oxylabs.io/scraping-solutions/web-scraper-api#request-parameter-values
     */
    public const string SOURCE_AMAZON_PRICING = 'amazon_pricing';

    public const string SOURCE_AMAZON_PRODUCT = 'amazon_product';

    public const string SOURCE_AMAZON_SEARCH = 'amazon_search';

    public const string SOURCE_AMAZON_SELLERS = 'amazon_sellers';

    public const string SOURCE_AMAZON_BESTSELLERS = 'amazon_bestsellers';

    public const string SOURCE_AMAZON_REVIEWS = 'amazon_reviews';

    public const string SOURCE_AMAZON_QUESTIONS = 'amazon_questions';

    public const string SOURCE_GOOGLE_SEARCH = 'google_search';

    public const string SOURCE_GOOGLE_ADS = 'google_ads';

    public const string SOURCE_GOOGLE_IMAGES = 'google_images';

    public const string SOURCE_GOOGLE_LENS = 'google_lens';

    public const string SOURCE_GOOGLE_MAPS = 'google_maps';

    public const string SOURCE_GOOGLE_TRAVEL_HOTELS = 'google_travel_hotels';

    public const string SOURCE_GOOGLE_SUGGEST = 'google_suggest';

    public const string SOURCE_GOOGLE_TRENDS_EXPLORE = 'google_trends_explore';

    public const string SOURCE_GOOGLE_SHOPPING_PRODUCT = 'google_shopping_product';

    public const string SOURCE_GOOGLE_SHOPPING_SEARCH = 'google_shopping_search';

    public const string SOURCE_GOOGLE_SHOPPING_PRICING = 'google_shopping_pricing';

    public const string SOURCE_BING_SEARCH = 'bing_search';

    public const string SOURCE_KROGER_PRODUCT = 'kroger_product';

    public const string SOURCE_KROGER_SEARCH = 'kroger_search';

    public const string SOURCE_WALMART_PRODUCT = 'walmart_product';

    public const string SOURCE_WALMART_SEARCH = 'walmart_search';

    public const string TARGET_KROGER = 'kroger';

    public const string TARGET_BING = 'bing';

    public const string TARGET_AMAZON = 'amazon';

    public const string TARGET_GOOGLE = 'google';

    public const string TARGET_WALMART = 'walmart';

    public const array SOURCES = [
        self::TARGET_AMAZON => [
            self::SOURCE_AMAZON_PRICING,
            self::SOURCE_AMAZON_PRODUCT,
            self::SOURCE_AMAZON_SELLERS,
            self::SOURCE_AMAZON_BESTSELLERS,
            self::SOURCE_AMAZON_REVIEWS,
            self::SOURCE_AMAZON_QUESTIONS,
            self::SOURCE_AMAZON_SEARCH,
        ],
        self::TARGET_GOOGLE => [
            self::SOURCE_GOOGLE_SEARCH,
            self::SOURCE_GOOGLE_ADS,
            self::SOURCE_GOOGLE_IMAGES,
            self::SOURCE_GOOGLE_LENS,
            self::SOURCE_GOOGLE_MAPS,
            self::SOURCE_GOOGLE_TRAVEL_HOTELS,
            self::SOURCE_GOOGLE_SUGGEST,
            self::SOURCE_GOOGLE_TRENDS_EXPLORE,
            self::SOURCE_GOOGLE_SHOPPING_PRODUCT,
            self::SOURCE_GOOGLE_SHOPPING_SEARCH,
            self::SOURCE_GOOGLE_SHOPPING_PRICING,
        ],
        self::TARGET_KROGER => [
            self::SOURCE_KROGER_PRODUCT,
            self::SOURCE_KROGER_SEARCH,
        ],
        self::TARGET_BING => [
            self::SOURCE_BING_SEARCH,
        ],
        self::TARGET_WALMART => [
            self::SOURCE_WALMART_PRODUCT,
            self::SOURCE_WALMART_SEARCH,
        ],
    ];

    public static function getSourcesForTarget(string $target): array
    {
        return self::SOURCES[$target] ?? [];
    }

    public static function validSource(string $source): bool
    {
        return in_array($source, Arr::flatten(self::SOURCES));
    }
}
