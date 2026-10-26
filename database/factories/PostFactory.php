<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(),
            'content' => fake()->realText(),
            'created_at' => now(),
            'post_type_id' => PostType::inRandomOrder()->value('id') ?? PostType::factory(),
            'user_id' => User::factory(),
        ];
    }
}
