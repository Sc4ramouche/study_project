@extends('template.site')

@section('content')

<section class="catalog-links">
  <div class="container">
    <nav class="catalog-navigation">
      <ul class="catalog-list">
        <li><a href="#">Наплитная посуда</a></li>
        <li><a href="#">Формы для выпечки</a></li>
        <li><a href="#">Кухонные инструменты</a></li>
        <li><a href="#">Ножи и разделочные доски</a></li>
        <li><a href="#">Предметы сервировки</a></li>
        <li><a href="#">Системы хранения</a></li>
      </ul>
    </nav>
  </div>
</section>

<div class="container">
  <ul class="breadcrumb">
    <li><a href="#">Главная</a></li>
    <li>О нас</li>
  </ul>
</div>

<section class="about-page">
  <div class="container about-page-container">
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



@endsection()
