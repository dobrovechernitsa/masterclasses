@extends('layouts.app')

@section('title', 'Добавление мастер-класса')

@section('content')
<div class="row row--nogutter top-line">
    <div class="line"></div>
</div>
<div class="main">
    <div class="row">
        <div class="row--small">
            <form action="{{ route('instructor.master-classes.store') }}" method="POST">
                @csrf
                <h2>Форма добавления мастер-класса</h2>
                
                <div class="form-group">
                    <label>Вид творчества</label>
                    <select name="category_id">
                        <option value="">Выберите вид творчества</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Название мастер-класса</label>
                    <input type="text" name="title" value="{{ old('title') }}">
                </div>
                
                <div class="form-group">
                    <label>Описание мастер-класса</label>
                    <textarea name="description">{{ old('description') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Дата</label>
                    <input type="date" name="date" value="{{ old('date') }}">
                </div>
                
                <div class="form-group">
                    <label>Время</label>
                    <select name="time_slot">
                        <option value="">Выберите время</option>
                        <option value="9-11" {{ old('time_slot') == '9-11' ? 'selected' : '' }}>9:00 - 11:00</option>
                        <option value="11-13" {{ old('time_slot') == '11-13' ? 'selected' : '' }}>11:00 - 13:00</option>
                        <option value="13-15" {{ old('time_slot') == '13-15' ? 'selected' : '' }}>13:00 - 15:00</option>
                        <option value="15-17" {{ old('time_slot') == '15-17' ? 'selected' : '' }}>15:00 - 17:00</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Количество человек в группе</label>
                    <input type="number" name="max_participants" value="{{ old('max_participants') }}" min="1">
                </div>
                
                <div class="form-group">
                    <label>Стоимость мастер-класса</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0">
                </div>
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
                
                <div class="form-group">
                    <button type="submit" class="btn">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
@endsection