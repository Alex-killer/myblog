<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\Admin\BaseController;
use App\Models\Blog\Article;
use App\Models\Blog\BlogCategory;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Article::paginate(10); // создаем объект $paginator и помещаем в него значене которое берем из модели Article

        return view('blog.admin.articles.index', compact('paginator')); // вместо compact('paginator'), можно написать ['paginator'=>$paginator], в параметр 'paginator' будут передаваться все значения из переменной $paginator, т.е. все значения из БД постранично
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        $item = Article::find($id); // функция find вернет либо объект класса Article найденое по идентификатору($id), либо вернет нул // $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) { // если пришло пустое
            return back() // делаем редирект назад
            ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]) // кладем в сессию с помощью withErrors само сообщение и текст сообщения "Запись id=[{$id}] не найдена"
            ->withInput(); // при ошибки чтобы,  те данные которые пришли, вернуть назад (чтобы те данные которые вводили сохранились, чтобы не пришлось все вводить заново)
        }

        $data = $request->all(); // масив всех данных которые пришли вместе с request (т.е. то что мы вводили в форме)
        $result = $item // у нас есть искомый элемент который мы будем редактировать $item
        ->fill($data) // заполим обновим свойства нашего оъекта, но они еще в базу не попадут (fill будет пробегаься по масиву $data по ключу нахдить сответствующее поле в нашем объкте и менять тем знаечением котоое пришло (кода мы редактруем запись))
        ->save(); // записываем в базу
//        if (empty($data['slug'])) {
//            $data['slug'] = str_slug($data['title']);
//        }
//
//        $result = $item->update($data);

        if ($result) { // получаем результат работы
            return redirect()
                ->route('blog.admin.articles.edit', $item->id) // чтобы построить маршрут нам нужен идетификатор категории $item->id
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
