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
        {{$articles5->links('vendor.pagination.bootstrap-4')}} {{-- пагинация --}}
        <div>
            <a href="#" class="btn btn-outline-primary mb-4">Редактировать</a>
        </div>
    </ul>
@endsection
