<?php

namespace Database\Seeders;

use App\Models\Comment;
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
        Post::create([
            'title' => 'First Post',
            'content' => 'This is my first post!',
            'postedBy' => 1,
            'typeID' => 1
        ]);
        User::create([
            'name' => 'Jack Smith',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1
        ]);
        PostType::create([
            'typeName' => 'Food'
        ]);
        PostType::create([
            'typeName' => 'Games'
        ]);
        Comment::create([
            'userID' => 1,
            'comment' => 'This is awesome!',
            'likes' => 20, 'postID' => 1
        ]);
        Comment::create([
            'userID' => 1,
            'comment' => 'This is sucks',
            'likes' => 10,
            'postID' => 1
        ]);
    }
}
