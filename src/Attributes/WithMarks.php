<?php

namespace Maize\Markable\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class WithMarks
{
    /** @var string[] */
    public array $markClasses;

    public function __construct(string ...$markClasses)
    {
        $this->markClasses = $markClasses;
    }
}
