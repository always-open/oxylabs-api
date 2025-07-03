<?php

namespace AlwaysOpen\OxylabsApi\DTOs;

use Spatie\LaravelData\Data;

class SellerFeedbackSummary extends Data
{
    public function __construct(
        public readonly int|string $_30_days,
        public readonly int|string $_90_days,
        public readonly int|string $_all_time,
        public readonly int|string $_12_months,
    )
    {
    }

    public function toArray(): array
    {
        return [
            '30_days' => $this->_30_days,
            '90_days' => $this->_90_days,
            'all_time' => $this->_all_time,
            '12_months' => $this->_12_months,
        ];
    }
}
