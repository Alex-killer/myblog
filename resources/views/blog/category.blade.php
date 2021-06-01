@extends('layouts.blog')

@section('title')
    Контент
@endsection

@section('content')
{{--@include('includes.categories')--}}
    <h1>{{ $category->title }}</h1>
    <ul>
    @foreach ($posts4 as $post)
            <div class="card">
                <h5 class="card-header">{{ $post->title }}</h5>
                <div class="card-body">
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{route("blog_post", [$category->id, $post->id])}}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
    @endforeach
    </ul>
@endsection

