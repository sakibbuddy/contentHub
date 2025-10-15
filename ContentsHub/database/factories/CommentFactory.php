<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(),
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
        ];
    }
}