@extends('layouts.admin_layout')

@section('title', 'Добавить категорию')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить Новость</h1>
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
                        <form action="{{ route('blog.admin.articles.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input name="title"
                                           id="title"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите название категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Идентификатор (необязательно)</label>
                                    <input name="slug"
                                           id="slug"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите название идентификатора">
                                </div>
                                <div class="form-group">
                                    <label for="content_raw">Текст</label>
                                    <input name="content_raw"
                                           id="content_raw"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите текст">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Выберите категорию</label></br>
                                    <select name="category_id"
                                            id="category_id"
                                            class="form-control"
                                            placeholder="Выберите категорию"
                                            required>
                                        @foreach($categoryList as $categoryOption)
                                            <option value="{{ $categoryOption->id }}">{{ $categoryOption->id }}.{{ $categoryOption->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
