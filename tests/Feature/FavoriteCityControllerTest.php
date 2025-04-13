<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteCityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_favorite_city()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/favorites/add', [
            'city' => 'Caracas'
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Ciudad agregada a favoritos']);
    }

    public function test_user_can_remove_favorite_city()
    {
        $user = User::factory()->create();
        $user->favoriteCities()->create(['city' => 'Caracas']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/favorites/remove', [
            'city' => 'Caracas'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Ciudad eliminada de favoritos']);
    }

    public function test_user_can_toggle_favorite_city()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/favorites/toggle', [
            'city' => 'Bogotá'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Agregado']);
    }

    public function test_user_can_check_if_city_is_favorite()
    {
        $user = User::factory()->create();
        $user->favoriteCities()->create(['city' => 'Buenos Aires']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/favorites/isFavorite', [
            'city' => 'Buenos Aires'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['isFavorite' => true]);
    }

    public function test_user_can_list_favorites()
    {
        $user = User::factory()->create();
        $user->favoriteCities()->createMany([
            ['city' => 'Caracas'],
            ['city' => 'Bogotá'],
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/favorites/listFavoritesApi');

        $response->assertStatus(200)
                 ->assertJsonFragment(['city' => 'Caracas'])
                 ->assertJsonFragment(['city' => 'Bogotá']);
    }
}
