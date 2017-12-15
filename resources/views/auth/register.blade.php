@extends('template.site')

@section('content')
<h1>Регистрация</h1>
    <form role="form" method="POST" action="{{ url('/account/register') }}">
        {{ csrf_field() }}

        <label for="name">Имя</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus><br>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required><br>

        <label for="password">Пароль</label>
        <input id="password" type="password" class="form-control" name="password" required><br>

        <label for="password-confirm">Подтвердите пароль</label>
        <input id="password-confirm" type="password" name="password_confirmation" required><br>

        <button type="submit">Зарегестрироваться</button>
    </form>

@endsection
