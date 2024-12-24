<?php

namespace Tests\Feature;

use App\Exceptions\UserPreferencesNotSetException;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Exceptions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PersonalizedNewsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function personalized_articles_can_be_retrieved_only_by_logged_in_users(): void
    {
        $response = $this->getJson('/api/news/personalized');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_throws_exception_when_getting_personalized_articles_if_preferences_are_not_set(): void
    {
        Exceptions::fake();

        $articles = Article::factory(3)->create()->toArray();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/news/personalized');

        Exceptions::assertReported(function (UserPreferencesNotSetException $e) {
            return $e->getMessage() === 'User has not set any news preferences.';
        });
    }

    #[Test]
    public function it_retrieves_personalized_articles(): void
    {
        // Generate 40 articles
        Article::factory(2)->create(['source' => 'Sky News']);
        Article::factory(3)->create(['categories' => 'Tech']);
        Article::factory(1)->create(['author' => 'John Doe']);

        // These should not be included
        Article::factory(1)->create([
            'source' => 'WSJ',
            'categories' => 'History',
            'author' => 'Jane Doe'
        ]);
        Article::factory(2)->create([
            'source' => 'NyTimes',
            'categories' => 'Political',
            'author' => 'Jane Doe'
        ]);

        $user = User::factory()->create();

        // Set user preferences
        DB::table('user_preferences')->insert([
            'user_id' => $user->id,
            'sources' => implode(',', ['The Guardian', 'Sky News', 'BBC']),
            'categories' => implode(',', ['Sports', 'Tech', 'AI']),
            'authors' => implode(',', ['John Doe']),
        ]);

        $response = $this->actingAs($user)->get('/api/news/personalized');

        $response->assertOk();

        $response->assertJsonCount(6, 'data');
    }
}
