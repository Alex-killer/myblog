<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paginator = Post::orderBy('id', 'ASC')->paginate(10);

        return view('blog.admin.posts.index', compact('paginator')); // вместо compact('paginator'), можно написать ['paginator'=>$paginator]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory(); // создаем объект класса пустой, в нем нет данных
        $categoryList = BlogCategory::orderBy('id', 'ASC')->get();
        // = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.create',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input(); // получаем данные которые пришли с формы
        if (empty($data['slug'])) // если slug не пришел
        {
            $data['slug'] = str::slug($data['title']); // то тогда мы с помощью ларавельно str::slug делаем транслит нашего заголовка для слага
        }

        $post = (new Post())->create($data);
        $post->title = $request->title;
        $post->img = $request->img;
        $post->text = $request->text;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->back()->withSuccess('Пост успешно добавлен');


//
//        $new_post = (new Post())->create($data);
//
//
//        if ($new_post) {
//            return redirect()->back() // делаем редирект на изменение
//            ->with(['success' => 'Статья успешно добавлена']); // отправляем 'success'
//        } else {
//            return back()->withErrors(['msg' => 'Ошибка сохранения'])
//                ->withInput(); // чтобы человек не потерял данные при ошибки
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Post::findOrFail($id);
        $categoryList = BlogCategory::orderBy('id', 'ASC')->get();
//        $categoriesList = BlogCategory::orderBy('created_at', 'DESC')->get();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
//        return view('blog.admin.posts.edit', [
//            'categories' => $categoriesList,
//            'post' => $post,
//        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->input(); // получаем данные которые пришли с формы
        if (empty($data['slug'])) // если slug не пришел
        {
            $data['slug'] = str::slug($data['title']); // то тогда мы с помощью ларавельно str::slug делаем транслит нашего заголовка для слага
        }

        $post->title = $request->title;
        $post->img = $request->img;
        $post->slug = $request->slug;
        $post->text = $request->text;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->back()->withSuccess('Пост успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Пост был успешно удален');
    }
}
