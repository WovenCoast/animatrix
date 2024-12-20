<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function configure() {
        return $this->afterMaking(function (Article $article) {
           $article->addMediaFromUrl('https://picsum.photos/1920/1080')->toMediaCollection("featured_image");
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence(),
            "slug" => $this->faker->slug(),
            "excerpt" => $this->faker->paragraph(),
            "content" => $this->faker->paragraph(),
            "published" => true,
            "published_at" => $this->faker->dateTime()->format('Y-m-d H:i'),
//            "published_at" => substr($this->faker->dateTime()->format('Y-m-d H:i:s'), 0, -3),
        ];
    }
}
