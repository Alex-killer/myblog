<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8), true);
        $txt = $this->faker->realText(rand(1000, 4000));
        $isPublished = rand(1, 5) > 1;

        $created_At = $this->faker->dateTimeBetween('-3 months', '-2 months');

        return [
            'category_id'   => rand(1, 11),
            'title'         => $title,
            'slug'          => str::slug($title),
            'excerpt'       => $this->faker->text(rand(40, 100)),
            'content_raw'   => $txt,
            'content_html'  => $txt,
            'is_published'  => $isPublished, # опубликовано или нет
            'published_at'  => $isPublished ? $this->faker->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at'    => $created_At,
            'updated_at'    => $created_At,
        ];
    }
}
