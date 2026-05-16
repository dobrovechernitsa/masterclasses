@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="row row--nogutter top-line">
    <div class="line"></div>
</div>
<div class="main">
    <div class="row">
        <div class="row--small">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h2>Форма регистрации</h2>
                
                <div class="form-group">
                    <label>ФИО</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}">
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password">
                </div>
                
                <div class="form-group">
                    <label>Подтверждение пароля</label>
                    <input type="password" name="password_confirmation">
                </div>
                
                <div class="form-group">
                    <label>Номер телефона</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}">
                </div>
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
                
                <div class="form-group">
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </div>
                
                <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
            </form>
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
@endsection