<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\Blog\BlogCategory;
use Illuminate\Support\Str;

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
        $item = new BlogCategory(); // создаем объект класса пустой, в нем нет данных
        $categoryList = BlogCategory::all();
        // = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.create',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input(); // получаем данные которые пришли с формы
        if (empty($data['slug'])) // если slug не пришел
        {
            $data['slug'] = str::slug($data['title']); // то тогда мы с помощью ларавельно str::slug делаем транслит нашего заголовка для слага
        }

        //Первый способ создания
        //Создаст объект но не добавит в БД
//        $item = new BlogCategory($data);
//        $item->save();

        // второй способ создания
        // Создаст объект и добавит в БД
        $item = (new BlogCategory())->create($data); // создаем BlogCategory пустой и вызываем метод create в него тправляем данные ($data)

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id]) // делаем редирект на изменение, отправляем id
            ->with(['success' => 'Успешно сохранено']); // отправляем 'success'
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput(); // чтобы человек не потерял данные при ошибки
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // BlogCategoryRepository $categoryRepository - создание объекта класса, равнозначно $categoryRepository = new BlogCategoryRepository
    {
        $item = BlogCategory::findOrFail($id); // findOrFail - ищет по id, если не найдет вернет 404 ошибку
        $categoryList = BlogCategory::all(); //получаем все категории из базы, чтобы выводить открывающийся список

        //$item = $categoryRepository->getEdit($id); // получить запись по id для ее последующего редактирования
        //$categoryList = $categoryRepository->getForComboBox(); // получить объекты для ComboBox(выпадающего списка)

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id) //BlogCategoryUpdateRequest - валидация, request - это инструментарий с помощью которого мы можем работать с входящими данными (определять путь, определять ip и т.д), $id ({category}) - идентификатор берем его из маршрута  admin/blog/categories/{category}
    {
        $item = BlogCategory::find($id); // функция find вернет либо объект класса BlogCategory найденое по идентификатору($id), либо вернет нул // $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) { // если пришло пустое
            return back() // делаем редирект назад
            ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]) // кладем в сессию с помощью withErrors само сообщение и текст сообщения "Запись id=[{$id}] не найдена"
            ->withInput(); // при ошибки чтобы,  те данные которые пришли, вернуть назад (чтобы те данные которые вводили сохранились, чтобы не пришлось все вводить заново), условия прописаны в item_edit_main_col с помощью хелперской функции old
        }

        $data = $request->all(); // масив всех данных которые пришли вместе с request (т.е. то что мы вводили в форме)
        if (empty($data['slug'])) {
            $data['slug'] = str::slug($data['title']);
        }

        $result = $item->update($data); // у нас есть искомый элемент который мы будем редактировать $item

        // 2 способ, но лучше использовать ($result = $item->update($data);), т.к. в него уже входят ->fill($data), ->save();
//        $result = $item
//        ->fill($data) // заполим обновим свойства нашего оъекта, но они еще в базу не попадут (fill будет пробегаься по масиву $data по ключу нахдить сответствующее поле в нашем объкте и менять тем знаечением котоое пришло (кода мы редактруем запись)). Так же чторбы все сработало, нужно указать в модели какие данные можно редпктировать
//        ->save(); // записываем в базу

//        if (empty($data['slug'])) {
//            $data['slug'] = str_slug($data['title']);
//        }
//
//        $result = $item->update($data);

        if ($result) { // получаем результат работы после  ->save();
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
