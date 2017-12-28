@extends('template.site')

@section('content')

<section class="catalog-links">
  <div class="container">
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
      <hr class="promo-line-red card-line-red">
      <h4>В наличии</h4>
      <b class="card-price">2072&#8381;</b>
      <form class="card-info-form" action="index.html" method="post">
        <div class="card-form-color">
          <label for="color">Цвет</label>
            <div class="card-form-container">
              <label class="checkmark-container">
                <input type="radio" name="color" checked>
                <span class="card-checkmark" id="violet"></span>
              </label>
            </div>

            <div class="card-form-container">
              <label class="checkmark-container">
                <input type="radio" name="color">
                <span class="card-checkmark" id="blue"></span>
              </label>
            </div>
        </div>
        <div class="card-form-quantity">
          <!-- <label for="number">Количество</label>
          <input type="number" name="quanity" value="1" min="1"> -->
          <div class="quantity">
            <label for="quantity">Количество</label>
            <input type="number" min="1" max="9" step="1" value="1" name="quantity">
          </div>
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
    <div class="catalog-tab">
      <button class="tablinks" onclick="openSection(event, 'Description')" id="defaultOpen">Описание</button>
      <button class="tablinks" onclick="openSection(event, 'Characteristics')">Характеристики</button>
      <button class="tablinks" onclick="openSection(event, 'Reviews')">Отзывы(2)</button>
    </div>

    <!-- Tab content -->
    <div id="Description" class="tabcontent">
      <p class="card-paragraph"><strong class="item-name">Кастрюля  Nadoba Augusta</strong>
        подойдет для приготовления
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
      <div class="card-review">
        <div class="card-stars">
        </div>
        <blockquote cite="Наталия">
        <cite>Наталия</cite>
        <time datetime="2017-10-26">26.10.2017</time>
        <p>Сделана качественно, отличные крепления,
          толстое дно, нержавеющая сталь, покупкой очень довольна.</p>
        </blockquote>
      </div>
      <div class="card-review">
        <div class="card-stars">
        </div>
        <blockquote cite="Светлана">
        <cite>Светлана</cite>
        <time datetime="2017-11-5">11.5.2017</time>
        <p>Посуда NADOBA уже зарекомендовала себя как надежная, красивая и удобная.
          Толстое дно, отличные антипригарное покрытие,
          можно использовать металлические лопатки и ложки!
          Моя помошница по хозяйству.</p>
        </blockquote>
      </div>
    </div>
  </div>
</section>

<section class="card-similar">
  <div class="container">
  <h2>Похожие товары</h2>
  <hr class="promo-line">
  <div class="catalog-home">
    <div class="catalog-item">
      <h6>New</h6>
      <a href="#"><a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a></a>
      <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
      <hr class="promo-line">
      <b>2 329&#8381;</b>
      <a href="#" class="catalog-item-cart">В корзину</a>
    </div>
    <div class="catalog-item">
      <h6>New</h6>
      <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
      <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
      <hr class="promo-line">
      <b>2 329&#8381;</b>
      <a href="#" class="catalog-item-cart">В корзину</a>
    </div>
    <div class="catalog-item">
      <h6>New</h6>
      <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
      <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
      <hr class="promo-line">
      <b>2 329&#8381;</b>
      <a href="#" class="catalog-item-cart">В корзину</a>
    </div>
    <div class="catalog-item">
      <h6>New</h6>
      <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
      <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
      <hr class="promo-line">
      <b>2 329&#8381;</b>
      <a href="#" class="catalog-item-cart">В корзину</a>
    </div>
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

<script type="text/javascript">
jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function() {
    var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });
</script>


@endsection()
