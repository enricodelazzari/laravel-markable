<?php

namespace Maize\Markable\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class MarkAllowedValues
{
    public array|string $values;

    public function __construct(string ...$values)
    {
        $this->values = count($values) === 1 && $values[0] === '*'
            ? '*'
            : $values;
    }
}
