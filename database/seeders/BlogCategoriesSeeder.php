<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++)
        DB::table('blog_categories')->insert([
            'title' => 'Category' .$i,
            'slug' => 'category -' .$i,
        ]);
    }
}
