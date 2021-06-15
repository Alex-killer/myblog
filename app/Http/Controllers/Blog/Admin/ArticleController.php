<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\Admin\BaseController;
use App\Models\Blog\Article;
use App\Models\Blog\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginator = Article::orderBy('created_at', 'DESC')->paginate(10); // создаем объект $paginator и помещаем в него значене которое берем из модели Article

        return view('blog.admin.articles.index', compact('paginator')); // вместо compact('paginator'), можно написать ['paginator'=>$paginator], в параметр 'paginator' будут передаваться все значения из переменной $paginator, т.е. все значения из БД постранично
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

        return view('blog.admin.articles.create',
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
        // 1 способ более длинный
//        $new_category = new BlogCategory($data);
//        $new_category->title = $request->title; // в поле title присваеваем title, который мы присылаем из формы
//        $new_category->save(); // сохраняем

        // 2 способ включат в себя все строки выше
        $new_article = (new Article())->create($data);

        //return redirect()->back()->withSuccess('Категория успешно добавлена');
        if ($new_article) {
            return redirect()->back() // делаем редирект на изменение
            ->with(['success' => 'Успешно сохранено']); // отправляем 'success'
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput(); // чтобы человек не потерял данные при ошибки
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Article::findOrFail($id); // findOrFail - ищет по id, если не найдет вернет 404 ошибку
        $categoryList = BlogCategory::all(); //получаем все категории из базы, чтобы выводить открывающийся список

        return view('blog.admin.articles.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->category_id = $request->category_id;
        $article->content_raw = $request->content_raw;
        $article->save();

        return redirect()->back()->withSuccess('Новость была успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->back()->withSuccess('Категория была успешно удалена');
    }
}
