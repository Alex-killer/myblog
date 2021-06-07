@extends('layouts.blog')

@section('title')
    Редактирование
@endsection

@section('content')
    @php /** @var \App\Models\Blog\BlogCategory $item */ @endphp
        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}"> {{-- если не прописывать метод (@method('PATCH')), то laravel не найдет маршрут и сюда же нельзя написать просто PATCH (смотреть маршруты) и выдаст ошибку, нужно писать ниже @method('PATCH') --}}
            @method('PATCH') {{-- метод отправки формы (PATCH - это когда ты редактируешь сущности и меняешь что то чуть-чуть(пару параметров), а PUT - это когда одну сущность заменяешь другой) --}}
            @csrf {{-- отправляем токен, чтобы защитить форму от хакинга --}}
            <div class="container">
                @php
                    /** @var \Illuminate\Support\ViewErrorBag $errors */ // переменная $errors берется из ларавел
                @endphp
                {{-- Плашка которая будет появляться с ошибкой или с успехом --}}
                {{-- этот блог кода выводится если к нам поступил ->withErrors из CategoryController update --}}
                @if($errors->any()) {{-- смотрим переменную $errors, если в ней хоть что то есть any(), то выполняем код --}}
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ $errors->first() }} {{-- получаем первую ошибку из списка --}}
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success')) {{-- session хелперская(ларавеля) функция - в session ищем ключ 'success', если найден то выполянется код --}}
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ session()->get('success') }} {{-- получаем значение этого ключа, обращаемся к сесии (session()) получить ключ 'success' --}}
                            </div>
                        </div>
                    </div>
                @endif
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('blog.admin.categories.includes.item_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.categories.includes.item_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>
@endsection
