@extends('layouts.blog')

@section('title')
    Категории
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{--Панель навигации--}}
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary " href="{{ route('blog.admin.categories.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Категория</th>
                                <th>Родитель</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)  {{--Пробегаемся по каждому элементу и каждый элемент будет называться item--}}
                            @php /** @var \App\Models\Category $item */ @endphp
                            <tr>
                               <td>{{ $item->id }}</td> {{-- выводим идентификатор--}}
                                <td>
                                    <a href="{{ route('blog.admin.categories.edit', $item->id) }}">  {{-- задаем значение переменной, $item->id - идентификатор текущей записи(на которую переходим) --}}
                                        {{ $item->title }} {{-- ссылка на редактирование --}}
                                    </a>
                                </td>
                                <td @if(in_array($item->parent_id, [0, 1])) style="color:#ccc" @endif> {{-- выводим идентификатор родителя --}}
                                    {{ $item->parent_id }}{{-- $item->parentCategory->title --}}
                                </td>
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
