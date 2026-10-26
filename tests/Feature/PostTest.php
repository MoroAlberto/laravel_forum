<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Database\Seeders\PostTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PostTableSeeder::class);
    }

    public function test_register_page_is_available_to_logged_in_users(): void
    {
        $response = $this->actingAs(User::find(1))->get('/register');

        $response->assertOk();
    }

    public function test_database_is_seeded(): void
    {
        $this->assertDatabaseHas('posts', [
            'title' => 'First Post',
        ]);
    }

    public function test_forum_index_is_paginated(): void
    {
        $response = $this->get('/forum');

        $response->assertOk();
        $response->assertViewHas('posts', fn ($posts) => $posts->count() === 4 && $posts->total() === 10);
    }

    public function test_logged_in_user_can_view_forum(): void
    {
        $this->actingAs(User::find(1))->get('/forum')->assertOk();
        $this->actingAs(User::find(1))->get('/forum/1')->assertOk();
        $this->actingAs(User::find(1))->get('/forum/create')->assertOk();
        $this->actingAs(User::find(1))->get('/forum/edit/1')->assertOk();
    }

    public function test_user_can_create_post(): void
    {
        $response = $this->actingAs(User::find(1))->post('/forum', [
            'title' => 'Brand new post',
            'content' => 'Lorem ipsum',
            'post_type_id' => 1,
        ]);

        $response->assertRedirect(route('forum.index'));
        $this->assertDatabaseHas('posts', ['title' => 'Brand new post', 'user_id' => 1]);
    }

    public function test_owner_can_update_post(): void
    {
        $response = $this->actingAs(User::find(1))->patch('/forum/1', [
            'title' => 'First Post',
            'content' => 'Updated content',
            'post_type_id' => 2,
        ]);

        $response->assertRedirect(route('forum.index'));
        $this->assertDatabaseHas('posts', ['id' => 1, 'content' => 'Updated content', 'post_type_id' => 2]);
    }

    public function test_other_users_cannot_edit_update_or_delete_post(): void
    {
        $intruder = User::factory()->create();

        $this->actingAs($intruder)->get('/forum/edit/1')
            ->assertRedirect(route('forum.index'));

        $this->actingAs($intruder)->patch('/forum/1', [
            'title' => 'Hacked',
            'content' => 'Hacked',
            'post_type_id' => 1,
        ])->assertForbidden();

        $this->actingAs($intruder)->delete('/forum/1')->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => 1, 'title' => 'First Post']);
    }

    public function test_owner_can_delete_post(): void
    {
        $this->actingAs(User::find(1))->delete('/forum/1')
            ->assertRedirect(route('forum.index'));

        $this->assertDatabaseMissing('posts', ['id' => 1]);
    }

    public function test_post_can_be_liked_only_once(): void
    {
        $post = Post::factory()->create(['post_type_id' => PostType::first()->id]);
        $user = User::find(1);

        $this->actingAs($user)->postJson('/like', ['post_id' => $post->id])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->actingAs($user)->postJson('/like', ['post_id' => $post->id])
            ->assertOk()
            ->assertJson(['success' => false]);

        $this->assertSame(1, $post->likes()->count());
    }

    public function test_user_can_comment_post(): void
    {
        $this->actingAs(User::find(1))->post('/add-comment', [
            'comment' => 'Nice!',
            'post_id' => 2,
        ])->assertRedirect();

        $this->assertDatabaseHas('comments', ['comment' => 'Nice!', 'post_id' => 2, 'user_id' => 1]);
    }
}
