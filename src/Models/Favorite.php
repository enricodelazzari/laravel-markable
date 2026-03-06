<?php

namespace Maize\Markable\Models;

use Maize\Markable\Attributes\MarkableRelation;
use Maize\Markable\Mark;

#[MarkableRelation('favoriters')]
class Favorite extends Mark {}
