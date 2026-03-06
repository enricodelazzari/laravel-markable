<?php

namespace Maize\Markable\Tests;

use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;
use Maize\Markable\Tests\Models\CustomLike;
use Maize\Markable\Tests\Models\MarkWithoutRelation;

class MarkableRelationAttributeTest extends TestCase
{
    /** @test */
    public function built_in_marks_resolve_relation_name_from_attribute(): void
    {
        $this->assertEquals('likers', Like::markableRelationName());
        $this->assertEquals('bookmarkers', Bookmark::markableRelationName());
        $this->assertEquals('favoriters', Favorite::markableRelationName());
        $this->assertEquals('reacters', Reaction::markableRelationName());
    }

    /** @test */
    public function custom_mark_resolves_relation_name_from_attribute(): void
    {
        $this->assertEquals('custom_likers', CustomLike::markableRelationName());
    }

    /** @test */
    public function mark_without_attribute_or_override_throws_runtime_exception(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/MarkWithoutRelation/');

        MarkWithoutRelation::markableRelationName();
    }
}
