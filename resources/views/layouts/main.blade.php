<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
<ul>
    <li>
        <a href="{{ route("main") }}">Главная страница</a>
    </li>
    <li>
        <a href="{{ route("contacts") }}">Контакты</a>
    </li>
    <li>
        <a href="{{ route("info") }}">Информация</a>
    </li>
    <li>
        <a href="{{ route("blog_categories") }}">Категории</a>
    </li>
    <li>
        <a href="{{ route("blog_article") }}">Новости</a>
    </li>
</ul>
@yield('content')
</body>
</html>
