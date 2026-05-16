@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="main">
    <div class="row">
        <div class="hover"></div>
        <div class="title">Добро пожаловать!</div>
        <div class="row--small grid between">
            <div class="content">
                <p>Добро пожаловать в клуб любителей творчества «ОчУмелые ручки»!</p>
                <p>Мы предлагаем мастер-классы по различным видам творчества. Выберите интересующее направление в меню справа и запишитесь на удобное время.</p>
                
                @auth
                    <h3>Мои записи на мастер-классы:</h3>
                    @if(isset($userBookings) && $userBookings->count() > 0)
                        @foreach($userBookings as $booking)
                            <p>
                                <b>{{ $booking->masterClass->category->name }}</b> - 
                                {{ $booking->masterClass->title }}<br>
                                Дата: {{ $booking->masterClass->date->format('d.m.Y') }}<br>
                                Время: {{ $booking->masterClass->time_display }}<br>
                                Ведущий: {{ $booking->masterClass->instructor->full_name }}
                            </p>
                        @endforeach
                    @else
                        <p>У вас пока нет записей на мастер-классы.</p>
                    @endif
                @else
                    <p><a href="{{ route('login') }}">Войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы записаться на мастер-классы.</p>
                @endauth
            </div>
            
            <ul class="menu">
                @foreach($categories as $category)
                    <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection