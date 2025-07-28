<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Google;

use Spatie\LaravelData\Data;

class GoogleShoppingProductReviewsByStar extends Data
{
    public function __construct(
        public readonly GoogleShoppingProductReviewByStar $_1,
        public readonly GoogleShoppingProductReviewByStar $_2,
        public readonly GoogleShoppingProductReviewByStar $_3,
        public readonly GoogleShoppingProductReviewByStar $_4,
        public readonly GoogleShoppingProductReviewByStar $_5,
    ) {}

    public function toArray(): array
    {
        return [
            '1' => $this->_1,
            '2' => $this->_2,
            '3' => $this->_3,
            '4' => $this->_4,
            '5' => $this->_5,
        ];
    }
}
