<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/user/register', [
            'name' => 'Kevin',
            'email' => 'kevin@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!'
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'user']);
    }

    public function test_user_can_login_and_get_token()
    {
        $user = User::factory()->create([
            'email' => 'kevin@example.com',
            'password' => bcrypt('Password123!')
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => 'kevin@example.com',
            'password' => 'Password123!'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['user', 'token']);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/user/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Sesión cerrada correctamente.']);
    }
}
