@extends('layouts.blog')

@section('title')
    Новости
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{--Панель навигации--}}
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary " href="{{ route('blog.admin.articles.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Категория</th>
                                <th>Название</th>
                                <th>Выдержка</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)  {{--Пробегаемся по каждому элементу и каждый элемент будет называться item (через эту переменную будем вывоить текст определенной записи)--}}
                            @php /** @var \App\Models\Article $item */ @endphp
                            <tr>
                               <td>{{ $item->id }}</td> {{-- выводим идентификатор--}}
                                <td @if(in_array($item->category_id, [0, 1])) style="color:#ccc" @endif> {{-- если категория 0 или 1 то выводить серым цветом --}}
                                    {{ $item->category_id }}{{-- $item->parentCategory->title --}} {{-- выводим категорию --}}
                                </td>
                                <td>
                                    <a href="{{ route('blog.admin.articles.edit', $item->id) }}">  {{-- задаем значение переменной, $item->id - идентификатор текущей записи(на которую переходим) ссылка чтобы заходить в новость --}}
                                        {{ $item->title }} {{-- ссылка на редактирование --}}
                                    </a>
                                </td>
                                <td>{{ $item->excerpt }}</td> {{-- выводим отрывок--}}

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count()) {{-- если общее количество записей больше количества записей текущего набора, то выводим пагинацию --}}
            <br>
            <div class="row justify-content-center ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
