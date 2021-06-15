@extends('layouts.admin_layout')

@section('title', 'Добавить пользователя')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить пользователя</h1>
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
                        <form action="{{ route('blog.admin.users.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Введите название поста" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email"
                                           id="email"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Введите пароль</label>
                                    <input name="password"
                                           id="password"
                                           type="text"
                                           class="form-control"
                                           placeholder="Введите пароль (не менее 8 символов)">
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
