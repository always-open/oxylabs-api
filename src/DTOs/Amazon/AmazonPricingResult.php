<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Amazon;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class AmazonPricingResult extends Data
{
    public function __construct(
        public readonly AmazonPricingResultContent|string $content,
        public readonly int $page,
        public readonly string $url,
        public readonly string $job_id,
        public readonly bool $is_render_forced,
        public readonly int $status_code,
        public readonly ?string $parser_type = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public readonly ?Carbon $updated_at = null,
        public readonly ?string $parser_preset = null,
    ) {}

    public function isRaw(): bool
    {
        return is_string($this->content);
    }

    public function saveImageTo(string $imagePath): bool
    {
        $data = str_replace(' ', '+', $this->content);
        $img = base64_decode($data);
        $success = false;
        if ($img) {
            $success = file_put_contents($imagePath, $img);
        }

        return $success;
    }
}
