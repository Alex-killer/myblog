<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Category;
use Illuminate\Http\Request;
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
        $paginator = BlogCategory::orderBy('id', 'ASC')->paginate(10);

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
        $new_category = (new BlogCategory())->create($data);

        //return redirect()->back()->withSuccess('Категория успешно добавлена');
        if ($new_category) {
            return redirect()->back() // делаем редирект на изменение
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
    public function update(Request $request, BlogCategory $category)
    {
        $category->title = $request->title;
        $category->save();

        return redirect()->back()->withSuccess('Категория была успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Категория была успешно удалена');
    }
}
