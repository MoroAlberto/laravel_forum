<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        PostType::create([
            'id' => 1,
            'name' => 'Food'
        ]);
        PostType::create([
            'id' => 2,
            'name' => 'Games'
        ]);
        User::create([
            'id' => 1,
            'name' => 'Jack Smith',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1
        ]);
        Post::create([
            'id' => 1,
            'title' => 'First Post',
            'content' => 'This is my first post!',
            'post_type_id' => 1,
            'user_id' => 1
        ]);
        Post::create([
            'id' => 2,
            'title' => 'Second Post',
            'content' => 'This is my second post!',
            'post_type_id' => 2,
            'user_id' => 1
        ]);
        Comment::create([
            'user_id' => 1,
            'comment' => 'This is awesome!',
            'likes' => 20,
            'post_id' => 1
        ]);
        Comment::create([
            'user_id' => 1,
            'comment' => 'This is sucks',
            'likes' => 10,
            'post_id' => 1
        ]);
        Like::create([
            'post_id' => 1,
            'user_id' => 1
        ]);
        Post::factory(8)->create();
    }
}
