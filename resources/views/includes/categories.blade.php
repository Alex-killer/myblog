@extends('layouts.blog')

@section('title')
    Категории блога
@endsection

@section('content')

    <div class="btn-group mb-4 " role="group" aria-label="Basic outlined example">
        @foreach ($categories7 as $category)
            <a href="{{ route("blog_category", ["category" => $category]) }}" class="btn btn-outline-primary">{{ $category->title }}</a>
        @endforeach
    </div>
@endsection
