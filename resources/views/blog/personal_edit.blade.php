@extends('layouts.admin_layout')

@section('title', 'Личный кабинет')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Перевод денежных средств</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-body">
                        <div class="form-group">
                            <label for="id">Выберите получателя</label></br>
                            <select name="id"
                                    id="id"
                                    class="form-control"
                                    placeholder="Выберите получателя"
                                    required>
                                @foreach($userList as $userOption)
                                    <option value="{{ $userOption->id }}">{{ $userOption->id }}.{{ $userOption->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="title">Сумма перевода</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div >
                            <div class="inner">
                                <h3>Ваш баланс</h3>

                                <p>{{ Auth::user()->balance }} $</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
