<?php

namespace Maize\Markable\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class MarkableRelation
{
    public function __construct(public string $name) {}
}
