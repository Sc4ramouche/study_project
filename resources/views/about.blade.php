<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
  <link rel="stylesheet" href="{{ asset('css/media.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="{{ asset('js/jquery/dist/jquery.js') }}"></script>
  <title>Дом Посуды</title>
</head>
<body>
  <header>
    <div class="header-top">
      <div class="container-custom container-header-top">
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
      <div class="container-custom container-header-bottom">
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

<section class="catalog-links">
  <div class="container-custom">
    <nav class="catalog-navigation">
      <ul class="catalog-list">
        <li><a href="/catalog/1">Посуда для приготовления</a></li>
        <li><a href="/catalog/2">Посуда для сервировки</a></li>
        <li><a href="/catalog/3">Хранение на кухне</a></li>
        <li><a href="/catalog/4">Кухонная утварь</a></li>
      </ul>
    </nav>
  </div>
</section>

<div class="container-custom">
  <ul class="breadcrumb-c">
    <li><a href="#">Главная</a></li>
    <li>О нас</li>
  </ul>
</div>

<section class="about-page">
  <div class="container-custom about-page-container">
    <div class="about-page-image">
      <img src="img/about-us-fountain.jpg" alt="Дом Посуды">
    </div>
    <div class="about-page-text">
      <h1>Дом Посуды</h1>
      <p class="first-chunk">Широкий выбор    товаров для вашей кухни от лучших производителей.
         Представленная в каталоге продукция поможет в сервировке стола
         и приготовлении блюд. Мы предлагаем посуду в наборах,
         что позволит сэкономить деньги и время на поиск необходимых предметов.</p>
      <p class="second-chunk">Мы постоянно расширяем свой ассортимент, сегодня мы можем вам
        предложить купить  в огромном многообразии тарелки,
        сковороды, ножи. </p>
      <p class="third-chunk">Посуда из нержавеющей стали и из безопасных пластмасс,
         а также высококлассная деревянная и фарфоровая посуда
         украсит любую кухню. У нас можно купить фарфор,
          столовые приборы, принадлежности для СВЧ, нержавеющие кастрюли,
          сковороды, оригинальные аксессуары для оборудования
          и оформления кухни, стаканы и фужеры для напитков и вин,
          приспособления для выпечки   и сервировки стола. </p>
    </div>
  </div>
</section>

<section class="about-slider container-custom">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block img-fluid" src="img/carousel-photo.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-3.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-4.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-5.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-6.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-7.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-8.jpg" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="img/gallery-9.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="about-us-description">
    <h2>Наша история</h2>
    <p>Вот уже 15 лет сеть магазинов "ДОМ ПОСУДЫ"
      радует своих покупателей высочайшим качеством товара,
      доступными ценами и постоянно обновляющимся ассортиментом.
      Наш каталог посуды включает в себя все необходимое для создания
      домашнего уюта. </p>
  </div>
</section>

<script type="text/javascript">
  $('.carousel').carousel({
    interval: 1000
  })
</script>

<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>

</script>
 <script>
 document.getElementById("defaultOpen").click();
 </script>

</body>
</html>
