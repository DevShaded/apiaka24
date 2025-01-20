<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence('15');
        $slug = Str::slug($title);

        // tags needs to be an json of words
        $tags = $this->faker->words();

        // convert it to json
        $tags = json_encode($tags);
        return [
            'title' => $title,
            'slug' => $slug,
            'image_url' => $this->faker->image(),
            'lead' => $this->faker->paragraph(),
            'content' => $this->generateHtmlContent(),
            'is_published' => true,
            'tags' => $tags,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
        ];
    }

    private function generateHtmlContent(): string
    {
        return <<<HTML
        <p>{$this->faker->paragraph()}</p>
        <ul>
            <li>{$this->faker->sentence()}</li>
            <li>{$this->faker->sentence()}</li>
            <li>{$this->faker->sentence()}</li>
        </ul>
        <p>{$this->faker->paragraph()}</p>
        HTML;
    }
}
