<?php

namespace Maize\Markable\Tests;

use Maize\Markable\Exceptions\InvalidMarkValueException;
use Maize\Markable\Tests\Models\Article;
use Maize\Markable\Tests\Models\AttributeReaction;
use Maize\Markable\Tests\Models\User;
use Maize\Markable\Tests\Models\WildcardReaction;

class MarkAllowedValuesAttributeTest extends TestCase
{
    /** @test */
    public function it_returns_allowed_values_from_attribute(): void
    {
        $this->assertEquals(['heart', 'love', 'haha'], AttributeReaction::allowedValues());
    }

    /** @test */
    public function it_returns_wildcard_from_attribute(): void
    {
        $this->assertEquals('*', WildcardReaction::allowedValues());
    }

    /** @test */
    public function attribute_takes_precedence_over_config(): void
    {
        config()->set('markable.allowed_values.attributereaction', ['config_value']);

        $this->assertEquals(['heart', 'love', 'haha'], AttributeReaction::allowedValues());
    }

    /** @test */
    public function it_rejects_invalid_values_defined_by_attribute(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $this->expectException(InvalidMarkValueException::class);
        AttributeReaction::add($article, $user, 'invalid_value');
    }

    /** @test */
    public function it_accepts_valid_values_defined_by_attribute(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        AttributeReaction::add($article, $user, 'heart');

        $this->assertTrue(AttributeReaction::has($article, $user, 'heart'));
    }

    /** @test */
    public function it_accepts_any_value_with_wildcard_attribute(): void
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        WildcardReaction::add($article, $user, 'anything_goes');

        $this->assertTrue(WildcardReaction::has($article, $user, 'anything_goes'));
    }

    /** @test */
    public function it_falls_back_to_config_when_no_attribute_is_set(): void
    {
        // Reaction has no #[MarkAllowedValues], so it reads from config
        $configured = config('markable.allowed_values.reaction');

        $this->assertEquals($configured, \Maize\Markable\Models\Reaction::allowedValues());
    }
}
