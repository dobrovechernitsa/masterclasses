@extends('layouts.app')

@section('title', 'Подтверждение записи')

@section('content')
<div class="row row--nogutter top-line">
    <div class="line"></div>
</div>
<div class="main">
    <div class="row">
        <div class="row--small">
            <form action="{{ route('booking.store', $masterClass) }}" method="POST">
                @csrf
                <h2>Подтверждение записи на мастер-класс</h2>
                
                <div class="form-group">
                    <label>ФИО участника</label>
                    <p>{{ auth()->user()->full_name }}</p>
                </div>
                
                <div class="form-group">
                    <label>Вид творчества</label>
                    <p>{{ $masterClass->category->name }}</p>
                </div>
                
                <div class="form-group">
                    <label>Название мастер-класса</label>
                    <p>{{ $masterClass->title }}</p>
                </div>
                
                <div class="form-group">
                    <label>ФИО мастера</label>
                    <p>{{ $masterClass->instructor->full_name }}</p>
                </div>
                
                <div class="form-group">
                    <label>Дата</label>
                    <p>{{ $masterClass->date->format('d.m.Y') }}</p>
                </div>
                
                <div class="form-group">
                    <label>Время</label>
                    <p>{{ $masterClass->time_display }}</p>
                </div>
                
                <div class="form-group">
                    <label>Стоимость</label>
                    <p>{{ $masterClass->price }} ₽</p>
                </div>
                
                <div class="form-group">
                    <label>Свободных мест</label>
                    <p>{{ $masterClass->available_spots }} из {{ $masterClass->max_participants }}</p>
                </div>
                
                @if(session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
                
                <div class="form-group">
                    <button type="submit" class="btn">Подтвердить запись</button>
                    <a href="{{ route('categories.show', $masterClass->category) }}" class="btn">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
@endsection