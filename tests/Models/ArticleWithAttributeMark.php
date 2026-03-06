<?php

namespace Maize\Markable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Attributes\WithMark;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;

#[WithMark(Like::class)]
#[WithMark(Favorite::class)]
#[WithMark(Bookmark::class)]
#[WithMark(Reaction::class)]
class ArticleWithAttributeMark extends Model
{
    use Markable;

    protected $table = 'articles';
}
