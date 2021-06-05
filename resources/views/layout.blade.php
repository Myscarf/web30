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
<header class="header">
    <div class="header__logo">
        <a class="header__link" href="{{route('news')}}">Лого</a>
    </div>
    <ul class="header__menu">
        <li class="header__item">
            <a class="header__link" href="{{route('news')}}">Новости</a>
        </li>
        <li class="header__item">
            <a class="header__link"  href="{{route('series')}}">Серии</a>
        </li>
        <li class="header__item">
            <a class="header__link" href="{{route('events')}}">События</a>
        </li>
        <li class="header__item">
            <a class="header__link" href="{{route('arcs')}}">Арки</a>
        </li>
        <li class="header__item">
            <a class="header__link" href="{{route('login')}}">@if(Auth::check()){{Auth::user()->name}} @else Вход @endif</a>
        </li>
    </ul>
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
            <div class="aside__header">Обо мне</div>
            <div class="aside__body">
                <ul class="footer__social-list aside__list">
                    @inject('socials' , "\App\Social")
                    @foreach($socials->show_social() as $social)
                    <li class="footer__social-item">
                        <a  class="footer__social-link {{$social->title_class}}" href="{{$social->link}}">{{$social->title}}</a>
                    </li>
                    @endforeach
                    <!--<li class="footer__social-item">
                        <a  class="footer__social-link footer__social-link--instagram" href="#">Instagram</a>
                    </li>
                    <li class="footer__social-item">
                        <a  class="footer__social-link footer__social-link--pinterest" href="#">Pinterest</a>
                    </li>
                    <li class="footer__social-item">
                        <a  class="footer__social-link footer__social-link--whatsapp" href="#">Whatsapp</a>
                    <li class="footer__social-item">
                        <a  class="footer__social-link footer__social-link--youtube" href="#">Youtube</a>
                    </li>-->
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
</body>
</html>
