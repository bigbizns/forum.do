<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'asdqwe123',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'username' => 'kepyklele',
            'email' => 'buyh4ck5@gmail.com',
            'password' => 'asdqwe123',
        ]);

        User::factory(6)->create();
        Category::factory(6)->create();
        SubCategory::factory(6)->create();
        Post::factory(4)->create();
    }
}
