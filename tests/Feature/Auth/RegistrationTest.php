<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_cant_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(302);
    }

    public function test_registration_screen_can_be_rendered_by_registered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
