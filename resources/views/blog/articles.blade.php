@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    <ul>
    @foreach ($articles as $article)

        <li>
            <a href="{{ route("blog_article", ["article" => $article]) }}">{{ $article->id }}. {{ $article->title }} </a>
        </li>

    @endforeach
    </ul>
@endsection
