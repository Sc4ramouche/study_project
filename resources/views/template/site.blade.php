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
        <nav class="header-navigation clearfix" id="nav">
          <label for="show-menu" class="show-menu">МЕНЮ</label>
          <input type="checkbox" id="show-menu" role="button">
          <ul class="header-menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/about">О нас</a></li>
            <li><a href="/catalog">Каталог товаров</a></li>
            <li><a href="/news">Новости</a></li>
            <li><a href="#feedback">Обратная связь</a></li>
            <li><a href="/delivery">Доставка</a></li>
            <li><a href="/contacts">Контакты</a></li>
          </ul>
        </nav>
        <div class="header-auth">
          <a href="/#">Личный кабинет</a>
        </div>
      </div>
    </div>

    <div class="header-bottom">
      <div class="container container-header-bottom">
        <div class="header-logo">
          <img src="{{ asset('img/logo.svg') }}" alt="Дом посуды">
        </div>
        <div class="header-brand">
          <h1 class="header-brand__name">Дом посуды</h1>
          <p class="header-brand__description">Интернет-магазин уютной посуды</p>
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
  });

  //Добавить товар в корзину с главной страницы
  function addProduct(data) {
      data = data.split(' ');
      var vendoreCode = data[0];
      var price = data[1];
      var count = 1;

      if ($.session.get("VendoreCodes") == undefined) {
        $.session.set("VendoreCodes", vendoreCode);
        $.session.set("VendoreCount", 1);
        $.session.set("Price", price);
        $.session.set("Counts", 1);
      }
      else {
        var allSessionDate = $.session.get("VendoreCodes");
        var allSessionCounts = $.session.get("VendoreCount");
        var SumPrice = Number($.session.get("Price"));
        var AllCount = Number($.session.get("Counts"));
        var flagIs = false; //флаг, для того чтобы узнать был такой товар в корзине или нет

        //проверить есть ли выбранный товар уже в корзине
        var arrayVendore = allSessionDate.split(' ');
        var arrayCount = allSessionCounts.split(' ')
        for (var i = 0; i < arrayVendore.length; i++) {
          if (vendoreCode == arrayVendore[i]) {    //если такой товар уже есть в корзине (сессии)
            arrayCount[i] = Number(arrayCount[i]) + Number(count); //увеличить кол-во товара
            flagIs = true; //поменять флаг, т.к. товар такой есть в корнизе
          }
        }

        if (flagIs == true) {
          var stringArrayVendore = "";
          var stringArrayCount = "";
          for (var i = 0; i < arrayVendore.length; i++) {
            if (i == 0) {
              stringArrayVendore += arrayVendore[i];
              stringArrayCount += arrayCount[i];
            }
            else {
              stringArrayVendore += ' ' + arrayVendore[i];
              stringArrayCount += ' ' + arrayCount[i];
            }
          }
          $.session.set("VendoreCodes", stringArrayVendore);
          $.session.set("VendoreCount", stringArrayCount);
        }
        else { //если товар новый в корзине, то добавить его в конец
          allSessionDate += ' ' + vendoreCode;
          allSessionCounts += ' ' + count;
          $.session.set("VendoreCodes", allSessionDate);
          $.session.set("VendoreCount", allSessionCounts);
        }

        SumPrice += Number(price);
        AllCount += Number(count);
        $.session.set("Price", SumPrice);
        $.session.set("Counts", AllCount);
      }

      count = $.session.get('Counts');
      price = $.session.get('Price');
      x = count + " товаров на " + price;
      $('#bucketName').text(x);
      $('#bucketName').append('&#8381;');
    }
</script>


<!-- content -->
@yield('content')
<!-- /content -->

<footer class="home-footer" id="footer">
  <div class="container container-footer">
    <div class="footer-brand">
      <h1>Дом посуды</h1>
      <p>Интернет-магазин уютной посуды</p>

      <p class="footer-description">Магазин Дом Посуды предлагает современную,
      красивую посуду и огромный выбор товаров для кухни.
      Наш каталог посуды включает в себя все
      необходимое для создания домашнего уюта.
      В ассортименте изделия из стекла, керамики, фарфора.
      Все товары отличаются стильным дизайном и прекрасно
      впишутся в декор любого дома.</p>
      <hr class="footer-promo-line">
      <p class="footer-adress">г. Санкт-Петербург  Дачный пр., д. 19 корп. 1</p>
      <p class="footer-telephone">+ 8 812 934 17 41, +8 812 756 81 69</p>
      <a href="#">info@domposudi.com</a>
    </div>
    <div class="footer-category">
      <h2>Категории</h2>
      <hr class="footer-promo-line promo-line-red">
      <ul class="footer-menu">
        <li><a href="/">Главная</a></li>
        <li><a href="/about">О нас</a></li>
        <li><a href="/catalog">Каталог товаров</a></li>
        <li><a href="/news">Новости</a></li>
        <li><a href="#">Обратная связь</a></li>
        <li><a href="/delivery">Доставка</a></li>
        <li><a href="/contacts">Контакты</a></li>
      </ul>
    </div>
    <div class="footer-feedback">
      <h2 id="feedback">Написать нам</h2>
      <hr class="footer-promo-line promo-line-red">
      <form class="footer-feedback-form" action="/SendEmail" method="post">
        <input type="text" name="username" placeholder="Ваше имя">
        <input type="email" name="email" placeholder="Ваша электронная почта">
        <textarea name="message" rows="4" cols="30" placeholder="Ваше сообщение"></textarea>
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input type="submit" name="submit" value="Отправить">
      </form>
    </div>
    <div class="footer-social">
      <h2>Мы Вконтакте</h2>
      <hr class="footer-promo-line promo-line-red">
      <div class="footer-gallery">
        <img src="img/gallery-1.jpg" alt="gallery-item">
        <img src="img/gallery-2.jpg" alt="gallery-item">
        <img src="img/gallery-3.jpg" alt="gallery-item">
        <img src="img/gallery-4.jpg" alt="gallery-item">
        <img src="img/gallery-5.jpg" alt="gallery-item">
        <img src="img/gallery-6.jpg" alt="gallery-item">
        <img src="img/gallery-7.jpg" alt="gallery-item">
        <img src="img/gallery-8.jpg" alt="gallery-item">
        <img src="img/gallery-9.jpg" alt="gallery-item">
      </div>
    </div>
  </div>

  <hr class="footer-promo-line copyright-line">
  <div class="footer-copyright">
    <p>&copy; 2017 Торговая марка ДОМ ПОСУДЫ. Все права защищены.</p>
    <p>Дизайн: Молодцова Виктория, Базаева Кристина</p>
    <p>Разработка: Литвинов Кирилл, Клочков Сергей, Ковеченков Владислав.</p>
  </div>
</footer>

<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>

</script>
 <script>
 document.getElementById("defaultOpen").click();
 </script>

  </body>
</html>
