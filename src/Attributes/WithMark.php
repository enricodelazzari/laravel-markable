<?php

namespace Maize\Markable\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WithMark
{
    public function __construct(public string $markClass)
    {
    }
}
