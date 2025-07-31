<?php

namespace AlwaysOpen\OxylabsApi\DTOs\Casters;

use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class DashToUnderscoreCasterIterable extends DashToUnderscoreCaster
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $convertedValues = [];
        foreach ($value as $item) {
            $convertedItem = [];
            foreach ($item as $key => $val) {
                $convertedItem[$this->convertKey($key)] = $val;
            }
            $convertedValues[] = new $property->type->dataClass(...$convertedItem);
        }

        return $convertedValues;
    }
}
