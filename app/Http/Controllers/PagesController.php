<?php

namespace App\Http\Controllers;

use App\Models\Blog\Article;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $articles6 = Article::orderBy('created_at', 'desc');

        return view('index')->with([
            'articles5' => $articles6->paginate(9) // масив днных для использования во вью
        ]);
    }

    public function contacts()
    {
        return view("contacts");
    }

    public function info()
    {
        return view("info");
    }
}
