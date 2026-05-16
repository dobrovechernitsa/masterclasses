@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="main">
    <div class="row">
        <div class="hover"></div>
        <div class="title">{{ $category->name }}</div>
        <div class="row--small grid between">
            <div class="content">
                @if($category->image)
                    <img src="{{ asset('img/' . $category->image) }}" alt="{{ $category->name }}" style="max-width: 100%; height: auto;">
                @else
                    <img src="{{ asset('img/elifant.png') }}" alt="{{ $category->name }}" style="max-width: 100%; height: auto;">
                @endif
                <p>{!! nl2br(e($category->description)) !!}</p>
            </div>
            
            <ul class="menu">
                @foreach($allCategories as $cat)
                    <li><a href="{{ route('categories.show', $cat) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="row shedule">
            <div class="row--small">
                <h2>Расписание</h2>
                
                @if(session('success'))
                    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
                @endif
                @if(session('error'))
                    <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
                @endif
                @if(session('info'))
                    <p style="color: blue; font-weight: bold;">{{ session('info') }}</p>
                @endif
                
                <div class="drivers">
                    @foreach($masterClasses as $masterClass)
                        <div class="driver grid">
                            <div class="driver-left grid">
                                <div class="driver-photo">
                                    <img src="{{ $masterClass->instructor->photo ? asset('img/' . $masterClass->instructor->photo) : asset('img/driver1.png') }}" alt="{{ $masterClass->instructor->full_name }}">
                                </div>
                                <div class="driver-text">
                                    <div class="driver-name">{{ $masterClass->instructor->full_name }}</div>
                                    <div class="driver-desc">
                                        Мастер-класс «{{ $masterClass->title }}»
                                        {{ $masterClass->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="driver-right">
                                @auth
                                    @php
                                        $userBooking = $masterClass->bookings
                                            ->where('user_id', auth()->id())
                                            ->where('status', 'confirmed')
                                            ->first();
                                    @endphp
                                    
                                    @if($userBooking)
                                        <p>Вы записаны</p>
                                        <form action="{{ route('booking.cancel', $userBooking) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="driver-btn">Отменить запись</button>
                                        </form>
                                    @elseif($masterClass->available_spots > 0)
                                        <a href="{{ route('booking.confirm', $masterClass) }}">
                                            <button class="driver-btn">записаться</button>
                                        </a>
                                    @else
                                        <button class="driver-btn" disabled>Мест нет</button>
                                    @endif
                                @endauth
                                <div class="driver-time">{{ $masterClass->date->format('d F') }} {{ $masterClass->time_display }}</div>
                                <div class="driver-time">Стоимость: {{ $masterClass->price }} ₽</div>
                                <div class="driver-time">Мест: {{ $masterClass->available_spots }}/{{ $masterClass->max_participants }}</div>
                            </div>  
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection