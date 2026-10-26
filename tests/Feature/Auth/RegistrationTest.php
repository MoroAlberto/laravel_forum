<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_cant_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(302);
    }

    public function test_registration_screen_can_be_rendered_by_admin()
    {
        $admin = User::factory()->admin()->create();
        $response = $this->actingAs($admin)->get('/register');
        $response->assertStatus(200);
    }

    public function test_registration_screen_is_forbidden_for_non_admin()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/register')->assertForbidden();
        $this->actingAs($user)->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertForbidden();

        $this->assertDatabaseMissing('users', ['email' => 'test@example.com']);
    }

    public function test_create_user_link_is_shown_only_to_admins()
    {
        $this->actingAs(User::factory()->create())->get('/forum')
            ->assertDontSee(route('register'));

        $this->actingAs(User::factory()->admin()->create())->get('/forum')
            ->assertSee(route('register'));
    }

    public function test_admin_can_create_users_and_stays_logged_in()
    {
        $admin = User::factory()->admin()->create();
        $response = $this->actingAs($admin)->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com', 'is_admin' => false]);
        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('forum.index', absolute: false));
    }
}
