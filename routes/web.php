<?php

use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\Blog\ArticleController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/', [PagesController::class, 'index'])->name("main");
Route::get('contacts', [PagesController::class, 'contacts'])->name("contacts");
Route::get('info', [PagesController::class, 'info'])->name("info");
Route::prefix("blog")->group(function () {
    Route::get('categories5', [CategoryController::class, 'index'])->name("blog_categories"); // выводит все категории
    Route::get('category/{category}', [CategoryController::class, 'show'])->name("blog_category");
    Route::get('category/{category1}/post/{post}/{pages?}', [PostController::class, 'show'])->name("blog_post");
    Route::get('articles6', [ArticleController::class, 'index'])->name("blog_articles");
    Route::get('article/{article}', [ArticleController::class, 'show'])->name("blog_article");
});
// Админка Блога
$groupData = [
    'middleware' => 'role:admin',
    'namespace' => 'App\Http\Controllers\Blog\Admin', // путь до самого контроллера
    'prefix'    => 'admin/blog', // отображение в адресной строке (url)
];
Route::group($groupData, function () {
    $methods = ['index', 'edit', 'update', 'create', 'store']; //index - список всех категорий edit - редактирование update - когда нажимаем сохранить идем сюда create - создание категории store - переходим сюда, когда нажимаем на кнопку создать
    Route::resource('categories', 'CategoryController')
        ->only($methods) // для каких методов нужно создать маршруты
        //->middleware(['auth'])
        ->names('blog.admin.categories');
});

$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix'    => 'admin/blog', // отображение в адресной строке (url)
];
Route::group($groupData, function () {
    $methods = ['index', 'edit', 'update', 'create', 'store']; //index - список всех категорий edit - редактирование update - когда нажимаем сохранить идем сюда create - создание категории store - переходим сюда, когда нажимаем на кнопку создать
    Route::resource('articles', 'ArticleController')
        ->only($methods) // для каких методов нужно создать маршруты
        ->middleware(['auth'])
        ->names('blog.admin.articles');
});
