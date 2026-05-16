<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Клуб «ОчУмелые ручки»')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body class="@yield('body_class')">
    <div class="header">
        <div class="row grid middle between">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Логотип">
                </a>
            </div>
            <div class="title">
                Клуб любителей творчества «ОчУмелые ручки»
            </div>
            <div class="auth">
                @auth
                    <span style="font-weight: bold; color: #00044c;">{{ auth()->user()->full_name }}</span>
                    @if(auth()->user()->isInstructor())
                        <a href="{{ route('instructor.cabinet') }}" style="margin-left: 15px;">Личный кабинет</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 15px;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #00044c; text-decoration: none; font-weight: bold; cursor: pointer; font-family: verdana; font-size: 16px; padding: 0;">Выход</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Вход</a>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="row row--nogutter">
        <div class="menu-burger">
            <div class="burger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>  
    </div>
    
    @yield('content')
    
    <div class="row row--nogutter">
        <div class="line"></div>
    </div>
    
    <div class="footer">
        <div class="row">
            <div class="row--small grid between">
                <div class="address">Наш адрес: ВДНХ, 120в</div>
                <div class="tel">Тел: 89123456765</div>
                <div class="copy">(с) Copyright, 2017</div>
            </div>
        </div>
    </div>
</body>
</html>