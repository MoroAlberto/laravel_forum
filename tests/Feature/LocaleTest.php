<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_switch_language(): void
    {
        $this->from('/forum')->post('/locale', ['locale' => 'it'])
            ->assertRedirect('/forum')
            ->assertSessionHas('locale', 'it');

        $this->get('/forum')
            ->assertOk()
            ->assertSee('Ultime discussioni');
    }

    public function test_unsupported_language_is_rejected(): void
    {
        $this->post('/locale', ['locale' => 'xx'])
            ->assertSessionHasErrors('locale')
            ->assertSessionMissing('locale');
    }

    public function test_browser_language_is_used_by_default(): void
    {
        $this->withHeader('Accept-Language', 'it-IT,it;q=0.9,en;q=0.8')
            ->get('/forum')
            ->assertSee('Ultime discussioni');
    }

    public function test_chosen_language_wins_over_browser_language(): void
    {
        $this->withSession(['locale' => 'en'])
            ->withHeader('Accept-Language', 'it-IT,it;q=0.9')
            ->get('/forum')
            ->assertSee('Latest discussions');
    }
}
