@extends('layouts.blog')

@section('title')
    Категории блога
@endsection

@section('content')
    <h1>{{ $category->title }}</h1>
    <ul>
    @foreach ($posts4 as $post)

            <li>
                <a href="{{route("blog_post", [$category->id, $post->id])}}">
                    {{ $post->title }}
                </a>
            </li>

    @endforeach
    </ul>
@endsection
