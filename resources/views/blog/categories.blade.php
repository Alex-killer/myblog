@extends('layouts.blog')

@section('title')
    Категории блога
@endsection

@section('content')
    <ul> {{ $c }} + {{ $b }}
    @foreach ($categories as $category)

        <li>
            <a href="{{ route("blog_category", ["category" => $category]) }}">{{ $category->title }}</a>
        </li>

    @endforeach
    </ul>
@endsection


