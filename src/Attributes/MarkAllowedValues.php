<?php

namespace Maize\Markable\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class MarkAllowedValues
{
    public array|string $values;

    public function __construct(string ...$values)
    {
        if (count($values) === 1) {
            if ($values[0] === '*') {
                $this->values = '*';

                return;
            }

            if (enum_exists($values[0])) {
                $this->values = array_column($values[0]::cases(), 'value');

                return;
            }
        }

        $this->values = $values;
    }
}
