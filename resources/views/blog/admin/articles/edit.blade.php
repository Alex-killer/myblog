@extends('layouts.admin_layout')

@section('title', 'Редактирование категории')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование новости: {{ $item['title'] }}</h1>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('blog.admin.articles.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input name="title"
                                           value="{{ $item['title'] }}"
                                           id="title"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите название категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Идентификатор (необязательно)</label>
                                    <input name="slug"
                                           value="{{ $item->slug }}"
                                           id="slug"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите название идентификатора">
                                </div>
                                <div class="form-group">
                                    <label for="content_raw">Текст</label>
                                    <input name="content_raw"
                                           value="{{ $item->content_raw }}"
                                           id="content_raw"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите текст">
                                </div>
                                <div class="form-group">
                                    <label>Выберите категорию</label>
                                    <select name="category_id"
                                            value="{{ $item['category_id'] }}"
                                            id="category_id"
                                            class="form-control"
                                            placeholder="Выберите категорию"
                                            required>
                                        @foreach($categoryList as $categoryOption)
                                            <option value="{{ $categoryOption->id }}"
                                                    @if($categoryOption->id == $item->category_id) selected @endif>
                                                {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                                {{--{{ $categoryOption->id_title }}--}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
