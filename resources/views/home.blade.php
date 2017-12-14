@extends('template.site')

@section('content')


<section class="jumbotron">
  <div class="promo">
    <div class="promo-text">
      <h2 class="promo-heading"><span class="promo-capture">Посуда, для уюта</span> <br> Вашего дома</h2>
      <hr class="promo-line">
      <h3 class="promo-slogan">Красивая посуда в каждой кухне</h3>
      <a href="#" class="promo-catalog">Каталог товаров</a>
    </div>
  </div>
</section>

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

<section class="catalog">
  <div class="container">
    <h2>Каталог товаров</h2>
    <hr class="promo-line">
    <div class="catalog-container">
      <div class="catalog-tab">
        <button class="tablinks" onclick="openSection(event, 'New')" id="defaultOpen">Новинки</button>
        <button class="tablinks" onclick="openSection(event, 'Leader')">Лидеры продаж</button>
        <button class="tablinks" onclick="openSection(event, 'Recommendation')">Рекомендуем</button>
      </div>

      <div id="New" class="tabcontent">
        <div class="catalog-new">
          <div class="catalog-item-new">
            <h6>New</h6>
            <img src="img/catalog.jpg" alt="Каталог товаров">
          </div>
          <div class="catalog-item-new">
            <h6>New</h6>
          </div>
          <div class="catalog-item-new">
            <h6>New</h6>
          </div>
          <div class="catalog-item-new">
            <h6>New</h6>
          </div>
        </div>
      </div>

      <div id="Leader" class="tabcontent">
        <h3>Paris</h3>
        <p>Paris is the capital of France.</p>
      </div>

      <div id="Recommendation" class="tabcontent">
        <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p>
      </div>
    </div>
  </div>
</section>
@endsection
