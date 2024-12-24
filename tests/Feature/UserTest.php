<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function only_logged_in_users_can_set_preferences(): void
    {
        $response = $this->postJson('/api/user/preferences', ['sources' => 'The Guardian']);

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_valides_user_preferences(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->postJson(
                                '/api/user/preferences',
                                []
                        );

        // Make assertions
        $response->assertStatus(422);

        $response->assertInvalid(['sources' => 'The sources field is required when none of categories / authors are present.']);
    }

    #[Test]
    public function preferences_must_be_in_array_format(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->postJson(
                                '/api/user/preferences',
                                ['categories' => 'Sports']
                        );

        // Make assertions
        $response->assertStatus(422);

        $response->assertInvalid(['categories' => 'The categories field must be an array.']);
    }

    #[Test]
    public function logged_in_users_can_set_preferences(): void
    {
        $user = User::factory()->create();

        $preferences = [
            'sources' => ['The Guardian', 'Sky News'],
            'categories' => ['Sports', 'Tech', 'AI'],
            'authors' => ['John Doe']
        ];

        $response = $this->actingAs($user)
                         ->postJson(
                                '/api/user/preferences',
                                $preferences
                        );

        $response->assertCreated();

        // Make assertions
        $this->assertDatabaseCount('user_preferences', 1);

        $this->assertDatabaseHas('user_preferences', [
            'user_id' => $user->id,
            'sources' => implode(',', $preferences['sources']),
            'categories' => implode(',', $preferences['categories']),
            'authors' => implode(',', $preferences['authors'])
        ]);
    }
}
