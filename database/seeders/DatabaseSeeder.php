<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $authors = Author::factory(10)->create();

        $categories = Category::factory(10)->create();

        Post::factory(10)->create([
            'author_id' => $authors->random()->id,
            'category_id' => $categories->random()->id,
        ]);
    }
}
