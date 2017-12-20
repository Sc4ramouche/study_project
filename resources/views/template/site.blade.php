<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
  <link rel="stylesheet" href="{{ asset('css/media.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  <script src="{{ asset('js/jquery/dist/jquery.js') }}"></script>
  <title>Дом Посуды</title>
</head>
<body>
  <header>
    <div class="header-top">
      <div class="container container-header-top">
        <a class="toggle open" href="#nav">МЕНЮ</a>
        <nav class="header-navigation" id="nav">
          <a class="toggle close" href="#">X</a>
          <ul class="header-menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/about">О нас</a></li>
            <li><a href="/catalog">Каталог товаров</a></li>
            <li><a href="/news">Новости</a></li>
            <li><a href="#">Обратная связь</a></li>
            <li><a href="/delivery">Доставка</a></li>
            <li><a href="/contacts">Контакты</a></li>
          </ul>
        </nav>
        <div class="header-auth">
          <a href="/account">Личный кабинет</a>
        </div>
      </div>
    </div>

    <div class="header-bottom">
      <div class="container container-header-bottom">
        <div class="header-logo">
          <img src="{{ asset('img/logo.svg') }}" alt="Дом посуды">
        </div>
        <div class="header-brand">
          <h1>Дом посуды</h1>
          <p>Интернет-магазин уютной посуды</p>
        </div>
        <div class="header-search">
          <form action="">
            <input type="search" placeholder="Поиск">
          </form>
        </div>
        <div class="header-cart">
          <h4>Корзина</h4>
          <p>15 товаров на 4500 &#8381;</p>
        </div>
        <div class="header-mobile">
          <h4>8 812 934 17 41</h4>
          <p>Контактный телефон</p>
        </div>
      </div>
    </div>
  </header>


<!-- content -->
@yield('content')
<!-- /content -->

<script src="{{ asset('js/common.js') }}"></script>
 <script>
 document.getElementById("defaultOpen").click();
 </script>



</body>
</html>
