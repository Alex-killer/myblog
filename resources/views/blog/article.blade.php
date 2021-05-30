@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    @foreach ($articles as $article)
        <li>
            <a href="{{ route("blog_article", ["article" => $article]) }}">{{ $article->title }}</a>
        </li>

    @endforeach
@endsection
