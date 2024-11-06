<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Dota2 Accounts',
            'Dota2 Boost',
            'CS2 Hacks',
            'CS2 Accounts',
            'CS2 Boost',
            'LoL Accounts',
            'LoL Boost',
            'Warzone Accounts',
            'Other',
            'Social Accounts',
        ];

        return [
            'category_id' => Category::all()->random()->id,
            'title' => $this->faker->randomElement($categories),
        ];
    }
}
