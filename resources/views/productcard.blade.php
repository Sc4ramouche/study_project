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
    <li><a href="#">Каталог товаров</a></li>
    <li><a href="#">Наплитная посуда</a></li>
    <li>Кастрюля Nadoba Augusta</li>
  </ul>
</div>

<section class="card-page">
  <div class="container container-card-page">
    <div class="card-gallery">
      <div class="card-slide">
        <img src="img/nadoba-augusta.jpg" style="width:100%">
      </div>
      <div class="card-slide">
        <img src="img/nadoba-augusta-cap.jpg" style="width:100%">
      </div>
      <div class="card-slide">
        <img src="img/nadoba-augusta.jpg" style="width:100%">
      </div>
      <div class="card-slide">
        <img src="img/nadoba-augusta-box.jpg" style="width:100%">
      </div>
      <div class="row">
        <div class="column">
          <img class="demo cursor" src="img/nadoba-augusta.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nadoba Augusta">
        </div>
        <div class="column">
          <img class="demo cursor" src="img/nadoba-augusta-cap.jpg" style="width:100%" onclick="currentSlide(2)" alt="Nadoba Augusta">
        </div>
        <div class="column">
          <img class="demo cursor" src="img/nadoba-augusta.jpg" style="width:100%" onclick="currentSlide(3)" alt="Nadoba Augusta">
        </div>
        <div class="column">
          <img class="demo cursor" src="img/nadoba-augusta-box.jpg" style="width:100%" onclick="currentSlide(4)" alt="Nadoba Augusta">
        </div>
      </div>
    </div>
    <div class="card-info">
      <h1>Кастрюля Nadoba Augusta</h1><b class="art">арт. 950493</b>
      <hr>
      <hr class="promo-line-red">
      <h4>В наличии</h4>
      <b class="card-price">2072&#8381;</b>
      <form class="card-info-form" action="index.html" method="post">
        <div class="card-form-color">
          <label for="color">Цвет</label>
              <input type="radio" id="violet" name="color" value="violet">
              <label for="violet"></label>
              <input type="radio" id="blue" name="color" value="blue">
              <label for="blue"></label>
        </div>
        <div class="card-form-quanity">
          <label for="number">Количество</label>
          <input type="number" name="quanity" value="1" min="1">
        </div>
        <div class="card-form-submit">
          <button type="button" name="add">Добавить в корзину</button>
          <button type="button" name="buy">Купить в один клик</button>
        </div>
      </form>
    </div>
  </div>
</section>

<section class="card-additional">
  <div class="container">
    <div class="tab">
      <button class="tablinks" onclick="openSection(event, 'Description')">Описание</button>
      <button class="tablinks" onclick="openSection(event, 'Characteristics')">Характеристики</button>
      <button class="tablinks" onclick="openSection(event, 'Reviews')">Отзыва</button>
    </div>

    <!-- Tab content -->
    <div id="Description" class="tabcontent">
      <p class="card-paragraph">Кастрюля  Nadoba Augusta подойдет для приготовления
        широкого спектра блюд: супов, каш, а также
        для тушения и пассеровки овощей. Равномерное
        распределение тепла способствует ускорению процесса
        приготовления блюд, сохраняя при этом большое
        количество полезных веществ и витаминов.
        Кастрюля подходит для использования со всеми видами
        плит, включая индукционные.
  </p>
    </div>

    <div id="Characteristics" class="tabcontent">
      <dl class="card-characteristics">
        <dt>Модель:</dt>
        <dd>Augusta</dd>
        <dt>Артикул:</dt>
        <dd>950493</dd>
        <dt>Подходит для индукционных плит:</dt>
        <dd>да</dd>
        <dt>Материал:</dt>
        <dd>алюминий,	нержавеющая сталь</dd>
        <dt>Материал крышки:</dt>
        <dd>стекло</dd>
        <dt>Страна производителя:</dt>
        <dd>Чешская Республика</dd>
        <dt>Бренд:</dt>
        <dd>Nadoba</dd>
      </dl>
    </div>

    <div id="Reviews" class="tabcontent">
      <h3>Отзывы</h3>
    </div>
  </div>
</section>

<script type="text/javascript">
  var slideIndex = 1;
  showSlides(slideIndex);

  function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
var i;
var slides = document.getElementsByClassName("card-slide");
var dots = document.getElementsByClassName("demo");
if (n > slides.length) {slideIndex = 1}
if (n < 1) {slideIndex = slides.length}
for (i = 0; i < slides.length; i++) {
  slides[i].style.display = "none";
}
for (i = 0; i < dots.length; i++) {
  dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex-1].style.display = "block";
dots[slideIndex-1].className += " active";
captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>


@endsection()
