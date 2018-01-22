<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
  <link rel="stylesheet" href="{{ asset('css/media.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="{{ asset('js/jquery/dist/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.session.js') }}"></script>
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
            <li><a href="#footer">Обратная связь</a></li>
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
          <h4><a href="/cart">Корзина</a></h4>
          <p id="bucketName"></p>
        </div>
        <div class="header-mobile">
          <h4>8 812 934 17 41</h4>
          <p>Контактный телефон</p>
        </div>
      </div>
    </div>
  </header>

<script>
  //Вставка сессий
  $(document).ready(function() {
    if ( ($.session.get('Price')) == undefined) {
      $('#bucketName').text("0 товаров на 0");
      $('#bucketName').append('&#8381;');
    }
    else {
      count = $.session.get('Counts');
      price = $.session.get('Price');
      x = count + " товаров на " + price;
      $('#bucketName').text(x);
      $('#bucketName').append('&#8381;');
    }
  })
</script>


<!-- content -->
@yield('content')
<!-- /content -->

<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>

</script>
 <script>
 document.getElementById("defaultOpen").click();
 </script>

</body>
</html>
