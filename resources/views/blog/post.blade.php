@extends('layouts.blog')

@section('title')
    Пост
@endsection

@section('content')
    <h1>{{ $category2->title }}</h1> {{-- $category берется из контроллера --}}
    <h2>{{ $post->title }}</h2>
    <div>
        <p>
            {{ $post->text }}
        </p>
    </div>
    <div>
        <p>{{ $pages }}</p>
    </div>
@endsection


