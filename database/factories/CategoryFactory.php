<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Discussions',
            'Gaming Marketplace',
            'Social Marketplace',
            'Dark Marketplace',
            'Gaming Discussions',
            'Social Discussions',
        ];

        $title = $this->faker->randomElement($categories);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'marketplace' => $this->faker->boolean('50'),
        ];
    }
}
