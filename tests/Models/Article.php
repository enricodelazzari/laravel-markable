<?php

namespace Maize\Markable\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;
use Maize\Markable\Tests\Models\AttributeReaction;
use Maize\Markable\Tests\Models\EnumReaction;
use Maize\Markable\Tests\Models\WildcardReaction;

class Article extends Model
{
    use HasFactory;
    use Markable;

    protected static $marks = [
        Like::class,
        Favorite::class,
        Bookmark::class,
        Reaction::class,
        AttributeReaction::class,
        WildcardReaction::class,
        EnumReaction::class,
    ];
}
