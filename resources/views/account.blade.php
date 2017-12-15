@extends('template.site')

@section('content')

<h1>Личный кабинет</h1>

    @if (Auth::guest())
        <li><a href="{{ url('/account/login') }}">Войти</a></li>
        <li><a href="{{ url('/account/register') }}">Зарегистрироваться</a></li>
    @else
        <p>Добро пожалоавть {{ Auth::user()->name }}</p>


<!-- Можно переделать в кнопку как в админке без выебонов -->
        <a href="{{ url('/account/logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            Выход
        </a>
        <form id="logout-form" action="{{ url('/account/logout') }}" method="GET" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif

@endsection()
