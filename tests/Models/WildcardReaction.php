<?php

namespace Maize\Markable\Tests\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Attributes\MarkAllowedValues;
use Maize\Markable\Mark;

#[MarkableRelation('wildcardreacters')]
#[MarkAllowedValues('*')]
class WildcardReaction extends Mark
{
    protected $table = 'markable_reactions';
}
