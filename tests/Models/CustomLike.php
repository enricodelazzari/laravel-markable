<?php

namespace Maize\Markable\Tests\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Mark;

#[MarkableRelation('custom_likers')]
class CustomLike extends Mark {}
