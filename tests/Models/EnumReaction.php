<?php

namespace Maize\Markable\Tests\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Attributes\MarkAllowedValues;
use Maize\Markable\Mark;
use Maize\Markable\Tests\Enums\ReactionType;

#[MarkableRelation('enumreacters')]
#[MarkAllowedValues(ReactionType::class)]
class EnumReaction extends Mark
{
    protected $table = 'markable_reactions';
}
