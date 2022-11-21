<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_response_no_login()
    {
        $response = $this->get('/forum');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_index_response_no_login()
    {
        $response = $this->get('/');
        $response->assertRedirect('/forum');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_show_response_no_login()
    {
        $response = $this->get('/forum/1');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_filter_response_no_login()
    {
        $response = $this->post('/filter', [
            'typeFilter' => 1
        ]);
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fallback_response_no_login()
    {
        $response = $this->get('/asd',);
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_create_response_no_login()
    {
        $response = $this->get('/forum/create');
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_store_response_no_login()
    {
        $response = $this->post('/forum', [
            'title' => 'Test Title',
            'content' => 'Loren Ipsum',
            'post_type_id' => 1,
        ]);
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_edit_response_no_login()
    {
        $response = $this->get('/forum/edit/1');
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_update_response_no_login()
    {
        $response = $this->patch('/forum/1', [
            'title' => 'Test Title',
            'content' => 'Loren Ipsum',
            'type' => 1,
        ]);
        $response->assertRedirect('/login');
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_forum_destroy_response_no_login()
    {
        $response = $this->delete('/forum/1');
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_comment_store_response_no_login()
    {
        $response = $this->post('/add-comment',[
            'comment' => 'Test comment',
            'post_id' => 1,
        ]);
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_like_store_response_no_login()
    {
        $response = $this->post('/like',[
            'post_id' => 1
        ]);
        $response->assertRedirect('/login');
    }
}
