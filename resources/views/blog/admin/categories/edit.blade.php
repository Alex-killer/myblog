@extends('layouts.blog')

@section('title')
    Редактирование
@endsection

@section('content')
    @php /** @var \App\Models\Blog\BlogCategory $item */ @endphp
        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}"> {{-- если не прописывать метод (@method('PATCH')), то laravel не найдет и выдаст ошибку --}}
            @method('PATCH') {{-- метод отправки формы (PATCH - это когда ты редактируешь сущности и меняешь что то чуть-чуть(пару параметров), а PUT - это когда одну сущность заменяешь другой) --}}
            @csrf
            <div class="container">
                @php
                    /** @var \Illuminate\Support\ViewErrorBag $errors */
                @endphp
                @if($errors->any())
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ $errors->first() }}
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ session()->get('success') }}
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
