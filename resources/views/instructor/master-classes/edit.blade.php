@extends('layouts.app')

@section('title', 'Редактирование мастер-класса')

@section('content')
<div class="row row--nogutter top-line">
    <div class="line"></div>
</div>
<div class="main">
    <div class="row">
        <div class="row--small">
            <form action="{{ route('instructor.master-classes.update', $masterClass) }}" method="POST">
                @csrf
                @method('PUT')
                <h2>Редактирование мастер-класса</h2>
                
                <div class="form-group">
                    <label>Название</label>
                    <p>{{ $masterClass->title }}</p>
                </div>
                
                <div class="form-group">
                    <label>Вид творчества</label>
                    <p>{{ $masterClass->category->name }}</p>
                </div>
                
                <div class="form-group">
                    <label>Дата и время</label>
                    <p>{{ $masterClass->date->format('d.m.Y') }}, {{ $masterClass->time_display }}</p>
                </div>
                
                <div class="form-group">
                    <label>Количество человек</label>
                    <p>{{ $masterClass->max_participants }}</p>
                </div>
                
                <div class="form-group">
                    <label>Описание мастер-класса</label>
                    <textarea name="description">{{ old('description', $masterClass->description) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Стоимость мастер-класса</label>
                    <input type="number" name="price" value="{{ old('price', $masterClass->price) }}" min="0">
                </div>
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
                
                <div class="form-group">
                    <button type="submit" class="btn">Сохранить изменения</button>
                    <a href="{{ route('instructor.cabinet') }}" class="btn">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
@endsection