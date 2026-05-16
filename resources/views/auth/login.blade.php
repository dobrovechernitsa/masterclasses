@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="row row--nogutter top-line">
    <div class="line"></div>
</div>
<div class="main">
    <div class="row">
        <div class="row--small">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2>Вход в личный кабинет</h2>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password">
                </div>
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
                
                <div class="form-group">
                    <button type="submit" class="btn">Войти</button>
                </div>
                
                <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
            </form>
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
@endsection