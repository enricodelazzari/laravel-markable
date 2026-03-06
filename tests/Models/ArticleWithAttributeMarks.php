<?php

namespace Maize\Markable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Attributes\WithMarks;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;

#[WithMarks(Like::class, Favorite::class, Bookmark::class, Reaction::class)]
class ArticleWithAttributeMarks extends Model
{
    use Markable;

    protected $table = 'articles';
}
