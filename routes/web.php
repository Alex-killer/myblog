<?php

use App\Http\Controllers\Blog\CategoryController;
use \App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index'])->name("main");
Route::get('contacts', [PagesController::class, 'contacts'])->name("contacts");
Route::get('info', [PagesController::class, 'info'])->name("info");
Route::prefix("blog")->group(function () {
    Route::get('categories', [CategoryController::class, 'index'])->name("blog_categories"); // выводит все категории
    Route::get('category/{category}', [CategoryController::class, 'show'])->name("blog_category");
    Route::get('category/{category1}/post/{post}/{pages?}', [PostController::class, 'show'])->name("blog_post");
    Route::get('article', [ArticleController::class, 'index'])->name("blog_article");
});
