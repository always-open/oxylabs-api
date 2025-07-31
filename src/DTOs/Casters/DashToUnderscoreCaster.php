<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class DashToUnderscoreCaster implements Cast
{
    public function __construct(
        public readonly bool $toLower = false,
    ){}

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $convertedValues = [];

        foreach ($value as $key => $val) {
            $convertedValues[$this->convertKey($key)] = $val;
        }

        return new $property->type->dataClass(...$convertedValues);
    }

    protected function convertKey(string $key): string
    {
        $newKey = str_replace('-', '_', $key);
        if ($this->toLower) {
            $newKey = strtolower($newKey);
        }
        return $newKey;
    }
}
