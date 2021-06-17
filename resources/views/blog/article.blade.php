@extends('layouts.blog')

@section('title', 'Новость')

@section('content')
    <h1>{{ $article->title }}</h1>
    <div>
        <p>
            {{ $article->content_raw }}
        </p>
    </div>
@endsection
