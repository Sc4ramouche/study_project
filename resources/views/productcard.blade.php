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
    <li><a href="/">Главная</a></li>
    <li><a href="/catalog/">Каталог товаров</a></li>
    <li><a href="/catalog/">{{ $product[0]->subname }}</a></li>
    <li>{{ $product[0]->type }} {{ $product[0]->model }} {{ $product[0]->brand }}</li>
  </ul>
</div>

<section class="card-page">
  <div class="container container-card-page">

    <div class="card-gallery">
      <div class="card-slide">
        <img src="/img/{{ $product[0]->pic }}.jpg" style="width:100%">
      </div>
      @foreach($sub_pic as $value)
      <div class="card-slide">
        <img src="/img/{{ $value->sec_pic }}.jpg" style="width:100%">
      </div>
      @endforeach


      <div class="row">
        <div class="column">
          <img class="demo cursor" src="/img/{{ $product[0]->pic }}.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nadoba Augusta">
        </div>
        @foreach($sub_pic as $value)
        <div class="column">
          <img class="demo cursor" src="/img/{{ $value->sec_pic }}.jpg" style="width:100%" onclick="currentSlide({{ $loop->iteration + 1 }})" alt="Nadoba Augusta">
        </div>
        @endforeach
      </div>
    </div>

    <div class="card-info">
      <h1>{{ $product[0]->type }}</h1><b class="art">арт. {{ $product[0]->VENDOR_CODE }}</b>
      <hr>
      <hr class="promo-line-red card-line-red">
      <h4>В наличии</h4>
      <b class="card-price">{{ $product[0]->Price }}&#8381;</b>
      <form class="card-info-form" action="index.html" method="post">
        <!-- <div class="card-form-color">
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
        </div> -->
        <div class="card-form-quantity">
          <!-- <label for="number">Количество</label>
          <input type="number" name="quanity" value="1" min="1"> -->
          <div class="quantity">
            <label for="quantity">Количество</label>
            <input type="number" min="1" max="9" step="1" value="1" name="quantity">
          </div>
        </div>
        <div class="card-form-submit">
          <button type="button" name="add" onclick="addCart()">Добавить в корзину</button>
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
      <!-- <button class="tablinks" onclick="openSection(event, 'Reviews')">Отзывы(2)</button> -->
    </div>

    <!-- Tab content -->
    <div id="Description" class="tabcontent">
      <p class="card-paragraph">
          {{ $product[0]->Description }}
      </p>
    </div>

    <div id="Characteristics" class="tabcontent">
      <dl class="card-characteristics">
        <dt>Артикул:</dt>
        <dd>{{ $product[0]->VENDOR_CODE }}</dd>
        <dt>Модель:</dt>
        <dd>{{ $product[0]->model }}</dd>
        <dt>Бренд:</dt>
        <dd>{{ $product[0]->brand }}</dd>
        <dt>Страна производителя:</dt>
        <dd>{{ $product[0]->country }}</dd>
        <dt>Материал:</dt>
        <dd>{{ $product[0]->material }}</dd>
        @foreach($characteristic as $val)
        <dt>{{ $val->name }}:</dt>
        <dd>{{ $val->value }}</dd>
        @endforeach

      </dl>
    </div>

    <!-- <div id="Reviews" class="tabcontent">
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
    </div> -->
  </div>
</section>

<section class="card-similar">
  <div class="container">
  <h2>Похожие товары</h2>
  <hr class="promo-line">

  <div class="catalog-home">
    @if(count($related_products) > 0)
    @foreach($related_products as $value)
    <div class="catalog-item">
      <label class="VENDOR_CODE" style="display:none">{{ $value->VENDOR_CODE}}</label>
      <a href="/productcard/{{ $value->VENDOR_CODE}}"><a href="/productcard/{{ $value->VENDOR_CODE}}"><img src="/img/{{ $value->pic }}.jpg" alt="Каталог товаров"></a></a>
      <p><a href="/productcard/{{ $value->VENDOR_CODE}}">{{ $value->type }} <br><span>{{ $value->brand }} {{ $value->model }}</span></a><p>
      <hr class="promo-line">
      <b>{{ $value->Price }}&#8381;</b>
      <a href="#" class="catalog-item-cart">В корзину</a>
    </div>
    @endforeach
    @endif
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

  //Вставка сессий
  //добавить артикул товара и количество товара в сессию
  //Price - общая сумма товаров
  //Count - общее кол-во товаров
  //VendoreCodes - все артикулы товаров
  //VendoreCount - кол-во каждого товара
  function addCart() {
    var count = $('input[name=quantity]').val();
    var str1 = $('.art').text();
    str1 = str1.split(' ');

    price = $('.card-price').text();
    price = price.slice(0, -1);
    price = Number(price) * Number(count);

    if ($.session.get("VendoreCodes") == undefined) {
      $.session.set("VendoreCodes", str1[1]);
      $.session.set("VendoreCount", count);
      $.session.set("Price", price);
      $.session.set("Counts", count);
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
        if (str1[1] == arrayVendore[i]) {    //если такой товар уже есть в корзине (сессии)
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
        allSessionDate += ' ' + str1[1];
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


@endsection()
