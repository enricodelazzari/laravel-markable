<?php

namespace Maize\Markable\Tests;

use Maize\Markable\Exceptions\InvalidMarkValueException;
use Maize\Markable\Tests\Enums\ReactionType;
use Maize\Markable\Tests\Models\Article;
use Maize\Markable\Tests\Models\EnumReaction;
use Maize\Markable\Tests\Models\User;

class BackedEnumTest extends TestCase
{
    /** @test */
    public function it_extracts_allowed_values_from_backed_enum_class(): void
    {
        $this->assertEquals(['heart', 'love', 'haha'], EnumReaction::allowedValues());
    }

    /** @test */
    public function it_accepts_a_backed_enum_case_in_add(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        EnumReaction::add($article, $user, ReactionType::Heart);

        $this->assertTrue(EnumReaction::has($article, $user, ReactionType::Heart));
        $this->assertDatabaseHas((new EnumReaction)->getTable(), [
            'markable_id' => $article->getKey(),
            'value' => 'heart',
        ]);
    }

    /** @test */
    public function it_accepts_a_backed_enum_case_in_remove(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        EnumReaction::add($article, $user, ReactionType::Love);
        $this->assertTrue(EnumReaction::has($article, $user, ReactionType::Love));

        EnumReaction::remove($article, $user, ReactionType::Love);
        $this->assertFalse(EnumReaction::has($article, $user, ReactionType::Love));
    }

    /** @test */
    public function it_accepts_a_backed_enum_case_in_toggle(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        EnumReaction::toggle($article, $user, ReactionType::Haha);
        $this->assertTrue(EnumReaction::has($article, $user, ReactionType::Haha));

        EnumReaction::toggle($article, $user, ReactionType::Haha);
        $this->assertFalse(EnumReaction::has($article, $user, ReactionType::Haha));
    }

    /** @test */
    public function it_accepts_a_backed_enum_case_in_count(): void
    {
        $article = Article::factory()->create();
        $users = User::factory(2)->create();

        EnumReaction::add($article, $users[0], ReactionType::Heart);
        EnumReaction::add($article, $users[1], ReactionType::Heart);

        $this->assertEquals(2, EnumReaction::count($article, ReactionType::Heart));
        $this->assertEquals(0, EnumReaction::count($article, ReactionType::Love));
    }

    /** @test */
    public function it_rejects_invalid_string_values_when_enum_defines_allowed_values(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $this->expectException(InvalidMarkValueException::class);
        EnumReaction::add($article, $user, 'invalid');
    }

    /** @test */
    public function it_is_consistent_between_enum_case_and_its_string_value(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        EnumReaction::add($article, $user, ReactionType::Heart);

        // enum case and its raw string value are equivalent
        $this->assertTrue(EnumReaction::has($article, $user, 'heart'));
        $this->assertTrue(EnumReaction::has($article, $user, ReactionType::Heart));
    }
}
