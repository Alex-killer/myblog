@extends('layouts.admin_layout')

@section('title', 'Все посты')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все посты</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- Плашка которая появляется сверху при сохранении -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th>
                                    Название
                                </th>
                                <th style="width: 30%">
                                    Идентификатор (Slug)
                                </th>
                                <th>
                                    Описание
                                </th>
                                <th>
                                    Обновлено
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($paginator as $item)  {{--Пробегаемся по каждому элементу и каждый элемент будет называться item--}}
                            <tr>
                                <td>
                                    {{ $item['id'] }}
                                </td>
                                <td>
                                    <a>
                                        {{ $item['title'] }}
                                    </a>
                                    <br>
                                    <small>
                                        {{ $item['created_at'] }}
                                    </small>
                                </td>
                                <td>
                                    {{ $item['slug'] }}
                                </td>
                                <td>
                                    {{ $item['description'] }}
                                </td>
                                <td>
                                    {{ $item['updated_at'] }}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('blog.admin.posts.edit', $item->id) }}"> {{-- $item->id - передаем id категории которую редактируем --}}
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('blog.admin.posts.destroy', $item->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <Button type="submit" class="btn btn-danger btn-sm delete-btn" href="#"> {{-- окно с подтверждением, взаимодействует с /public/admin.js --}}
                                            <i class="fas fa-trash">
                                            </i>
                                            Удалить
                                        </Button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
        </div><!-- /.container-fluid -->
    </section>
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
    <!-- /.content -->
@endsection
