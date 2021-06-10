<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="{{ route("main") }}" class="navbar-brand">My Blog</a>

            {{-- Кнопка гамбургер будет отображаться только в мобильной версии --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false"> {{-- false значит меню закрыто --}}
                <span class="navbar-toggler-icon"></span> {{-- Иконка нашего меню --}}
            </button>

            {{-- разворачивающиеся меню при нажатии на кнопку --}}
            <div class="collapse navbar-collapse " id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    @if (Route::has('login'))
                            @auth
                            <li class="nav-item">
                                <a href="{{ route("main") }}" class="nav-link">Главная страница</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("contacts") }}" class="nav-link">Контакты</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("info") }}" class="nav-link">Информация</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("blog_categories") }}" class="nav-link">Категории</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("blog_articles") }}" class="nav-link">Новости</a>
                            </li>
                            <form  method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button  type="button" class="btn btn-primary" :href="route('logout')"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">{{ __('Log Out') }}</button>
                            </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Войти</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
                            @endif
                            @endauth
                    @endif
                </ul>
{{--                <form class="d-flex">--}}
{{--                    <input type="search" placeholder="Search" class="form-control me-2">--}}
{{--                    <button class="btn btn-outline-success">Search</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </nav>
<div class="container">
    <h1 class="mt-5 mb-4 text-center">@yield('title')</h1>
@yield('content')
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</div>
</body>
</html>
