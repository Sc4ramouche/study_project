@extends('template.site')
@section('content')
<form class="" role="form" method="POST" action="{{ url('/admin/login') }}">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus><br>

    <label for="password">Пароль</label>
    <input id="password" type="password"name="password" required><br>

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Запомнить
    </label>

    <button type="submit">
        Войти
    </button><br>

    <a class="btn btn-link" href="{{ url('/password/reset') }}">
        Забыли пароль?
    </a>
</form>
@endsection
