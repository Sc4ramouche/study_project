@extends('template.site')

@section('content')

<section class="jumbotron">
  <div class="promo">
    <div class="promo-text">
      <h2 class="promo-heading"><span class="promo-capture">Посуда, для уюта</span> <br> Вашего дома</h2>
      <hr class="promo-line">
      <h3 class="promo-slogan">Красивая посуда в каждой кухне</h3>
      <a href="/catalog" class="promo-catalog">Каталог товаров</a>
    </div>
  </div>
</section>

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
        <div class="catalog-home">
            @if(count($new_products) > 0)
            @foreach($new_products as $value)
              <div class="catalog-item">
                <label class="VENDOR_CODE" style="display:none">{{ $value->VENDOR_CODE}}</label>
                <h6>New</h6>
                <a href="/productcard/{{ $value->VENDOR_CODE}}"><a href="/productcard/{{ $value->VENDOR_CODE}}"><img src="/img/{{ $value->pic }}" alt="Каталог товаров"></a></a>
                <p><a href="/productcard/{{ $value->VENDOR_CODE}}">{{ $value->type }} <br><span>{{ $value->brand }} {{ $value->model }}</span></a><p>
                <hr class="promo-line">
                <b>{{ $value->Price }}&#8381;</b>
                <a onclick="addProduct('{{ $value->VENDOR_CODE }} {{ $value->Price }}')" href="#" class="catalog-item-cart" role="button">В корзину</a>
              </div>
            @endforeach
            @endif
        </div>
      </div>

      <div id="Leader" class="tabcontent">
        <div class="catalog-home">
            @if(count($leader_products) > 0)
            @foreach($leader_products as $value)
              <div class="catalog-item">
                <label class="VENDOR_CODE" style="display:none">{{ $value->VENDOR_CODE}}</label>
                <h6>Top</h6>
                <a href="/productcard/{{ $value->VENDOR_CODE}}"><a href="/productcard/{{ $value->VENDOR_CODE}}"><img src="/img/{{ $value->pic }}" alt="Каталог товаров"></a></a>
                <p><a href="/productcard/{{ $value->VENDOR_CODE}}">{{ $value->type }} <br><span>{{ $value->brand }} {{ $value->model }}</span></a><p>
                <hr class="promo-line">
                <b>{{ $value->Price }}&#8381;</b>
                <a onclick="addProduct('{{ $value->VENDOR_CODE }} {{ $value->Price }}')" href="#" class="catalog-item-cart">В корзину</a>
              </div>
            @endforeach
            @endif
        </div>
      </div>

      <div id="Recommendation" class="tabcontent">
        <div class="catalog-home">
            @if(count($recomended_products) > 0)
            @foreach($recomended_products as $value)
              <div class="catalog-item">
                <label class="VENDOR_CODE" style="display:none">{{ $value->VENDOR_CODE}}</label>
                <h6>Best</h6>
                <a href="/productcard/{{ $value->VENDOR_CODE}}"><a href="/productcard/{{ $value->VENDOR_CODE}}"><img src="/img/{{ $value->pic }}" alt="Каталог товаров"></a></a>
                <p><a href="/productcard/{{ $value->VENDOR_CODE}}">{{ $value->type }} <br><span>{{ $value->brand }} {{ $value->model }}</span></a><p>
                <hr class="promo-line">
                <b>{{ $value->Price }}&#8381;</b>
                <a onclick="addProduct('{{ $value->VENDOR_CODE }} {{ $value->Price }}')" href="#" class="catalog-item-cart">В корзину</a>
              </div>
            @endforeach
            @endif

        </div>
      </div>
    </div>
  </div>
</section>

<section class="features">
  <div class="container">
    <ul>
      <li class="feature-item feature-age">15 лет на рынке</li>
      <li class="feature-item feature-quality">Гарантия качества</li>
      <li class="feature-item feature-price">Доступные цены</li>
      <li class="feature-item feature-range">Широкий ассортимент</li>
    </ul>
  </div>
</section>

<section class="news clearfix">
  <div class="container">
    <h2>Новости</h2>
    <hr class="promo-line">
    <div class="container-news">
      <div class="news-item clearfix">
        <img src="img/home-news.jpg" alt="Новости">
        <h3>Новая коллекция посуды от Luminarc Harena</h3>
        <p>Белоснежная линейка столовой посуды
         в греко-романском стиле придется по вкусу как любителям классики,
         так и поклонникам современного дизайна.</p>
         <a href="#">Читать далее</a>
      </div>
      <div class="news-item clearfix">
        <img src="img/home-news.jpg" alt="Новости">
        <h3>Новая коллекция посуды от Luminarc Harena</h3>
        <p>Белоснежная линейка столовой посуды
         в греко-романском стиле придется по вкусу как любителям классики,
         так и поклонникам современного дизайна.</p>
         <a href="#">Читать далее</a>
      </div>
      <div class="news-item clearfix">
        <img src="img/home-news.jpg" alt="Новости">
        <h3>Новая коллекция посуды от Luminarc Harena</h3>
        <p>Белоснежная линейка столовой посуды
         в греко-романском стиле придется по вкусу как любителям классики,
         так и поклонникам современного дизайна.</p>
         <a href="#">Читать далее</a>
      </div>
    </div>
  </div>
</section>

<section class="about-us">
  <div class="container">
    <h2>О нас</h2>
    <hr class="promo-line">
    <div class="container-about-us">
      <div class="home-about-us-description">
        <p class="first-paragraph">Интернет-магазин Дом Посуды предлагает широкий выбор
        товаров для вашей кухни от лучших производителей.
        Представленная в каталоге продукция поможет в сервировке
        стола и приготовлении блюд. Мы предлагаем посуду в наборах,
        что позволит сэкономить деньги и время на поиск необходимых предметов.</p>

        <p>Мы постоянно расширяем свой ассортимент,
        сегодня мы можем вам предложить купить  в огромном многообразии
        тарелки, сковороды, ножи. Посуда из нержавеющей
        стали и из безопасных пластмасс, а также высококлассная
        деревянная и фарфоровая посуда украсит любую кухню.
        У нас можно купить фарфор, столовые приборы,
        принадлежности для СВЧ, нержавеющие кастрюли, сковороды,
        оригинальные аксессуары для оборудования и оформления кухни,
        стаканы и фужеры для напитков и вин, приспособления для выпечки
        и сервировки стола. </p>
        <a href="#" class="read-more">Читать далее</a>
      </div>
      <div class="about-us-image">
        <img src="img/home-about-us.jpg" alt="О нас">
      </div>
    </div>
  </div>
</section>

<section class="home-subscribe">
  <h3>Подпишитесь на наши новости</h3>
  <form class="subcribe" action="/SendMailDispatch" method="post">
    <input type="email" name="email" placeholder="Ваша электронная почта"></input>
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <input type="submit" name="submit" value="Подписаться">
  </form>
</section>


<script>

  $('input[name="submit"]').bind("click", function() {

  });

</script>
@endsection()
