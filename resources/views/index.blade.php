@extends('layouts.main')

@section('title', 'Главная')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($articles5 as $article)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="/files/photo1.png" alt="user-image">
                            <div class="card-body">
                                <p class="card-text">{{ $article->title }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="btn btn-outline-dark" href="{{ route("blog_article", $article->id) }}" role="button">Подробнее</a>
                                    <small class="text-muted">{{ $article->updated_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
