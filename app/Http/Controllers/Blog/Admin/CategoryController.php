<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Models\Blog\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(4);

        return view('blog.admin.categories.index', compact('paginator')); // вместо compact('paginator'), можно написать ['paginator'=>$paginator]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id); // findOrFail - ищет по id, если не найдет вернет 404 ошибку
        $categoryList = BlogCategory::all(); //получаем все категории из базы, чтобы выводить открывающийся список

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //request - это инструментарий с помощью которого мы можем работать с входящими данными (определять путь, определять ip и т.д), $id ({category}) - идентификатор берем его из маршрута  admin/blog/categories/{category}
    {
        $item = BlogCategory::find($id); // функция find вернет либо объект класса BlogCategory найденое по идентификатору($id), либо вернет нул // $this->blogCategoryRepository->getEdit($id);
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
                ->route('blog.admin.categories.edit', $item->id) // чтобы построить маршрут нам нужен иднтификатор категории $item->id
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
