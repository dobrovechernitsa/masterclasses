@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('body_class', 'dp')

@section('content')
<div class="main">
    <div class="row">
        <div class="hover"></div>
        <div class="title"></div>
        <div class="row--small grid between">
            <div class="content driver-page">
                <div class="driver-page-photo">
                    <img src="{{ auth()->user()->photo ? asset('img/' . auth()->user()->photo) : asset('img/driver-page.png') }}" alt="{{ auth()->user()->full_name }}">
                </div>  
                <div class="driver-page-name">{{ auth()->user()->full_name }}</div>
                <div class="driver-page-text">
                    <div class="driver-page-my">Мои мастер-классы</div>
                    <table class="driver-page-table">
                        <tbody>
                            @foreach($masterClasses as $class)
                                <tr>
                                    <td>{{ $class->date->format('d F') }} {{ $class->time_display }}</td>
                                    <td>
                                        <b>{{ $class->title }}</b>
                                        <br>
                                        <a href="{{ route('instructor.master-classes.edit', $class) }}">Редактировать</a>
                                        @if($class->bookings->count() > 0)
                                            @foreach($class->bookings as $index => $booking)
                                                <p>
                                                    {{ $index + 1 }}. {{ $booking->user->full_name }}<br>
                                                    email: {{ $booking->user->email }}<br>
                                                    tel: {{ $booking->user->phone }}
                                                </p>
                                            @endforeach
                                        @else
                                            <p>Нет записавшихся</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="driver-page-btn-wrapper">
                    <a href="{{ route('instructor.master-classes.create') }}" class="driver-page-btn btn">
                        Добавить мастер-класс
                    </a>
                </div>
            </div>
            
            <ul class="menu">
                @foreach($allCategories as $category)
                    <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection