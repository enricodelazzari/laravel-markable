<?php

namespace Maize\Markable\Tests;

use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Favorite;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;
use Maize\Markable\Tests\Models\ArticleWithAttributeMark;
use Maize\Markable\Tests\Models\ArticleWithAttributeMarks;
use Maize\Markable\Tests\Models\User;

class AttributeMarkableTest extends TestCase
{
    /** @test */
    public function it_resolves_marks_from_repeatable_with_mark_attribute(): void
    {
        $marks = ArticleWithAttributeMark::marks();

        $this->assertContains(Like::class, $marks);
        $this->assertContains(Favorite::class, $marks);
        $this->assertContains(Bookmark::class, $marks);
        $this->assertContains(Reaction::class, $marks);
    }

    /** @test */
    public function it_resolves_marks_from_with_marks_attribute(): void
    {
        $marks = ArticleWithAttributeMarks::marks();

        $this->assertContains(Like::class, $marks);
        $this->assertContains(Favorite::class, $marks);
        $this->assertContains(Bookmark::class, $marks);
        $this->assertContains(Reaction::class, $marks);
    }

    /** @test */
    public function it_can_use_mark_on_model_registered_via_repeatable_attribute(): void
    {
        $article = ArticleWithAttributeMark::create([]);
        $user = User::factory()->create();

        $mark = Like::add($article, $user);

        $this->assertTrue(Like::has($article, $user));
        $this->assertDatabaseHas($mark->getTable(), [
            'user_id' => $user->getKey(),
            'markable_id' => $article->getKey(),
            'markable_type' => $article->getMorphClass(),
        ]);
    }

    /** @test */
    public function it_can_use_mark_on_model_registered_via_with_marks_attribute(): void
    {
        $article = ArticleWithAttributeMarks::create([]);
        $user = User::factory()->create();

        $mark = Like::add($article, $user);

        $this->assertTrue(Like::has($article, $user));
        $this->assertDatabaseHas($mark->getTable(), [
            'user_id' => $user->getKey(),
            'markable_id' => $article->getKey(),
            'markable_type' => $article->getMorphClass(),
        ]);
    }

    /** @test */
    public function it_does_not_duplicate_marks_when_combining_property_and_attributes(): void
    {
        $marks = ArticleWithAttributeMark::marks();

        $this->assertEquals(array_unique($marks), $marks);
    }

    /** @test */
    public function it_uses_markable_trait(): void
    {
        $this->assertContains(Markable::class, trait_uses_recursive(ArticleWithAttributeMark::class));
        $this->assertContains(Markable::class, trait_uses_recursive(ArticleWithAttributeMarks::class));
    }

    /** @test */
    public function it_can_filter_marked_models_via_attribute_registered_mark(): void
    {
        $articles = collect(range(1, 3))->map(fn () => ArticleWithAttributeMark::create([]));
        $users = User::factory(2)->create();

        $this->assertCount(0, ArticleWithAttributeMark::whereHasMark(app(Like::class), $users[0])->get());

        Like::add($articles[0], $users[0]);
        Like::add($articles[1], $users[0]);

        $this->assertCount(2, ArticleWithAttributeMark::whereHasMark(app(Like::class), $users[0])->get());
        $this->assertCount(0, ArticleWithAttributeMark::whereHasMark(app(Like::class), $users[1])->get());
    }
}
