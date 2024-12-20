<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public static $validUser = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'test@somedomain.com',
        'password' => 'Test1234!#',
        'password_confirmation' => 'Test1234!#'
    ];

    public static function invalidUserProvider() : array {
        return [
            [[...self::$validUser, ...['first_name' => '']]],
            [[...self::$validUser, ...['last_name' => 91723]]],
            [[...self::$validUser, ...['email' => 'test']]],
            [[...self::$validUser, ...['password_confirmation' => 'TEST1234!#']]]
        ];
    }

    #[Test]
    #[DataProvider('invalidUserProvider')]
    public function it_validates_register_request($invalidUser): void
    {
        $response = $this->postJson('/api/register', $invalidUser);

        $response->assertStatus(422);

        $this->assertDatabaseEmpty('users');
    }

    #[Test]
    public function it_registers_new_user(): void
    {
        $response = $this->postJson('/api/register', self::$validUser);

        $response->assertStatus(201);

        $user = self::$validUser;
        $user['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
        unset($user['password']);
        unset($user['password_confirmation']);

        $response->assertJsonFragment($user);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'email' => self::$validUser['email'],
        ]);
    }

    #[Test]
    public function it_validates_login_request(): void
    {
        $response = $this->postJson(
                        '/api/login',
                        ['email' => 'test', 'password' => 'test']
                    );

        $response->assertStatus(422);

        $response->assertInvalid(['email']);
    }

    #[Test]
    public function it_authenticates_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(
                        '/api/login',
                        ['email' => $user->email, 'password' => 'Test1234!#']
                    );

        $response->assertStatus(200);

        $response->assertValid();

        $user = $user->toArray();
        unset($user['email_verified_at']);
        $response->assertJsonFragment($user);

        $this->assertAuthenticated();
    }

    #[Test]
    public function it_logs_out_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/logout');

        $response->assertStatus(200);

        $this->assertGuest();
    }
}
