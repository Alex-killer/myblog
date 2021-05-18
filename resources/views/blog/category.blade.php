@extends('layouts.blog')

@section('title')
    Категории блога
@endsection

@section('content')
    <h1>{{ $category->title }}</h1>
    <ul>
    @foreach ($posts as $post)

        <li>{{ $post->title }}</li>

    @endforeach
    </ul>
@endsection


