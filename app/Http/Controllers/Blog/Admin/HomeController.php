<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\Article;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $category_count = BlogCategory::all()->count();
        $post_count = Post::all()->count();
        $article_count = Article::all()->count();
        $user_count = User::all()->count();

        return view('blog.admin.home.index',[
            'category_count' => $category_count,
            'post_count' => $post_count,
            'article_count' => $article_count,
            'user_count' => $user_count,
        ]);
    }
}
