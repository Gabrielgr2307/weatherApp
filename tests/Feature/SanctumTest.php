<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SanctumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'gabrielgr2307@gmail.com',
            'name' => 'Gabriel',
        ]);

        $response = $this->post('/api/user/login',[
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'user' => ['email' ,'name'],
            'token',
        ]);
    }
}
