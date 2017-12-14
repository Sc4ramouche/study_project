@extends('template.site')

@section('content')

<h1>Админ Панель</h1>

<form id="logout-form" action="{{ url('/admin/logout') }}" method="GET" >
    {{ csrf_field() }}
    <button type="submit">
        Выйти
    </button>
</form>

@endsection()
