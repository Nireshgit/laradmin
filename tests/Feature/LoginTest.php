<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDatabaseConnection()
    {
        $this->assertEquals('laradmin_test', \DB::connection()->getDatabaseName());
    }

    /**
     * Test successful login.
     *
     * @return void
     */
    public function testUserCanLoginWithValidCredentials()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'), // Make sure password is hashed
        ]);

        // Attempt to login with valid credentials
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Assert that the user was redirected to the intended page
        $response->assertRedirect('/home');

        // Assert that the user is authenticated
        $this->assertAuthenticatedAs($user);
    }
}
