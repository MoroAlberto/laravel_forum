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
            'typeName' => 'Food'
        ]);
        PostType::create([
            'typeName' => 'Games'
        ]);
        User::create([
            'name' => 'Jack Smith',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1
        ]);
        Post::create([
            'title' => 'First Post',
            'content' => 'This is my first post!',
            'post_type_id' => 1,
            'user_id' => 1
        ]);
        Post::create([
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
    }
}
