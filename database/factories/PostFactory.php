<?php

namespace Database\Factories;

use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            'title' => fake()->text(80),
            'body' => fake()->paragraph(),
            'thumbnail' => fake()->randomElement(
                [
                    'https://cdn.dummyjson.com/recipe-images/3.webp',
                    'https://cdn.dummyjson.com/recipe-images/6.webp',
                    'https://cdn.dummyjson.com/recipe-images/30.webp',
                    'https://cdn.dummyjson.com/recipe-images/13.webp',
                    'https://cdn.dummyjson.com/recipe-images/25.webp'
                ]
            ),
            'user_id' => User::all()->random()->id,
            'post_status_id' => PostStatus::all()->random()->id
        ];
    }
}
