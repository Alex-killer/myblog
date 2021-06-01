@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    <ul>
    @foreach ($articles5 as $article)

        <li>
            <a href="{{ route("blog_article", ["article" => $article]) }}">{{ $article->id }}. {{ $article->title }} </a>
        </li>

    @endforeach
        {{$articles5->links('vendor.pagination.bootstrap-4')}}
    </ul>
@endsection
