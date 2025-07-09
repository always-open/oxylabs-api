<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class SellerFeedbackSummaryDataEntry extends Data
{
    public function __construct(
        public readonly int|string $count,
        public readonly int|string $_1_star,
        public readonly int|string $_2_star,
        public readonly int|string $_3_star,
        public readonly int|string $_4_star,
        public readonly int|string $_5_star,
    ) {}

    public function toArray(): array
    {
        return [
            'count' => $this->count,
            '1_star' => $this->_1_star,
            '2_star' => $this->_2_star,
            '3_star' => $this->_3_star,
            '4_star' => $this->_4_star,
            '5_star' => $this->_5_star,
        ];
    }
}
