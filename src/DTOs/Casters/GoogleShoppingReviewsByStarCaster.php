<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductReviewByStar;
use AlwaysOpen\OxylabsApi\DTOs\Google\GoogleShoppingProductReviewsByStar;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class GoogleShoppingReviewsByStarCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return new GoogleShoppingProductReviewsByStar(
            GoogleShoppingProductReviewByStar::from($value['1']),
            GoogleShoppingProductReviewByStar::from($value['2']),
            GoogleShoppingProductReviewByStar::from($value['3']),
            GoogleShoppingProductReviewByStar::from($value['4']),
            GoogleShoppingProductReviewByStar::from($value['5']),
        );
    }
}
