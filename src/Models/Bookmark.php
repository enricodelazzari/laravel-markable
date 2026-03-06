<?php

namespace Maize\Markable\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Mark;

#[MarkableRelation('bookmarkers')]
class Bookmark extends Mark {}
