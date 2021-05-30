<?php

namespace Database\Seeders;

use App\Models\Blog\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BlogCategoriesSeeder::class);
        $this->call(BlogPostsSeeder::class);

        Article::factory()->count(30)->create(); // фабрика вызывается напрямую и указывается количество новостей
        //$this->call(NewsSeeder::class); // либо фабрику можно вызвать с помощью сидера

    }
}
