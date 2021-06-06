@extends('layouts.blog')

@section('title')
    Новость
@endsection

@section('content')
    <h1>{{ $article->title }}</h1>
    <div>
        <p>
            {{ $article->content_raw }}
        </p>
        <div>
            <a href="#" class="btn btn-outline-primary mb-4">Редактировать</a>
        </div>
    </div>
@endsection
