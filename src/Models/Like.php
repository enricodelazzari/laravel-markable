<?php

namespace Maize\Markable\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Mark;

#[MarkableRelation('likers')]
class Like extends Mark {}
