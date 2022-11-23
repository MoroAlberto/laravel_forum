<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\PostTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->seed(PostTableSeeder::class);
        Auth::loginUsingId(1);
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete()
    {
        $post = Post::factory()->make();
        if ($post) {
            $post->delete();
        }
        $this->assertTrue(true);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_database()
    {
        $this->assertDatabaseHas('posts',[
           'title' => 'First Post'
        ]);
    }
}
