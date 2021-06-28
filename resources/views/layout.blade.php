<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>@yield('title')</title>
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header__inner">
                    <a class="logo" href="{{route('news')}}">
                        <img class="logo__img" src="/images/marvel_logo.jpg" alt="logo">
                    </a>
                    <nav class="menu">
                        <ul class="menu__list">
                            <li class="menu__list-item">
                                <a class="menu__list-link" href="{{route('news')}}">Новости</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__list-link"  href="{{route('series')}}">Серии</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__list-link" href="{{route('events')}}">События</a>
                            </li>
                            <li class="menu__list-item">
                                <a class="menu__list-link" href="{{route('arcs')}}">Арки</a>
                            </li>
                        </ul>
                    </nav>
                    <span class="auth">
                      <a class="auth__link" href="{{route('login')}}">@if(Auth::check()){{Auth::user()->name}} @else Вход @endif </a>
                    </span>
                </div>
            </div>
        </header>

        <div class="my-container">
        @yield('content')

        <aside class="aside">
            @if(\Auth::check())
            <div class="aside__inner">
                <a class="aside__link" href="{{route('admin_post_get')}}">
                    <div class="aside__header">Администрирование</div>
                </a>
            </div>
            @endif

                <div class="aside__inner">
                    <a class="aside__link" href="{{route('cart')}}">
                        <div class="aside__header">Корзина</div>
                    </a>
                </div>

            <div class="aside__inner">
                <div class="aside__header">Персонажи</div>
                <div class="aside__body">
                    <ul class="aside__list">
                        @inject('characters', "\App\Character")
                        @foreach($characters->show_characters() as $character)
                        <li><a  class="aside__item" href="{{route('post_by_character', $character->key)}}">{{$character->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

                <div class="aside__inner">
                    <div class="aside__header">Самые популярные выпуски</div>
                    <div class="aside__body">
                        <ul class="aside__list">
                            @inject('posts', "\App\Post")
                            @foreach($posts->get_best_post() as $post)
                                <li><a  class="aside__item" href="{{route('single_post', $post->id)}}">{{$post->series}} #{{$post->issue}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="aside__inner">
                    <div class="aside__header">Случайный выпуск</div>
                    <div class="aside__body">
                        <ul class="aside__list">
                            @inject('posts', "\App\Post")
                            @foreach($posts->get_random_post() as $post)
                                <li><a  class="aside__item" href="{{route('single_post', $post->id)}}">
                                        <div class="aside__random-issue">
                                            <img class="post_title post_title--random-issue" src="/../titles/{{$post->series}}/{{$post->cover}}"></img>
                                            {{$post->series}} #{{$post->issue}}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            <div class="aside__inner">
                <div class="aside__header">Обо мне</div>
                <div class="aside__body">
                    <ul class="footer__social-list aside__list">
                        @inject('socials' , "\App\Social")
                        @foreach($socials->show_social() as $social)
                        <li class="footer__social-item">
                            <a  class="footer__social-link {{$social->title_class}}" href="{{$social->link}}">{{$social->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--<div class="aside__inner">
                <div class="aside__header">Сценаристы</div>
                <div class="aside__body">
                    <ul class="aside__list">
                        <li><a  class="aside__item" href="#">Марк Ми́ллар</a></li>
                    </ul>
                </div>
            </div>
            <div class="aside__inner">
                <div class="aside__header">Художники</div>
                <div class="aside__body">
                    <ul class="aside__list">

                        <li><a  class="aside__item" href="#">Steve McNiven</a></li>
                    </ul>
                </div>
            </div>-->
        </aside>
        </div>
    </div>
</body>
</html>
