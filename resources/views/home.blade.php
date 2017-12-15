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

      <div id="Leader" class="tabcontent">
        <div class="catalog-home">
          <div class="catalog-item">
            <h6>Top</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Top</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Top</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Top</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
        </div>
      </div>

      <div id="Recommendation" class="tabcontent">
        <div class="catalog-home">
          <div class="catalog-item">
            <h6>Best</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Best</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Best</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
          <div class="catalog-item">
            <h6>Best</h6>
            <a href="#"><img src="img/catalog.jpg" alt="Каталог товаров"></a>
            <p><a href="#">Кастрюля <br><span>Nadoba Dona</span></a><p>
            <hr class="promo-line">
            <b>2 329&#8381;</b>
            <a href="#" class="catalog-item-cart">В корзину</a>
          </div>
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

<section class="news">
  <div class="container">
    <h2>Новости</h2>
    <hr class="promo-line">
    <div class="container-news">
      <div class="news-item">
        <img src="img/home-news.jpg" alt="Новости">
        <h3>Новая коллекция посуды от Luminarc Harena</h3>
        <p>Белоснежная линейка столовой посуды
         в греко-романском стиле придется по вкусу как любителям классики,
         так и поклонникам современного дизайна.</p>
         <a href="#">Читать далее</a>
      </div>
      <div class="news-item">
        <img src="img/home-news.jpg" alt="Новости">
        <h3>Новая коллекция посуды от Luminarc Harena</h3>
        <p>Белоснежная линейка столовой посуды
         в греко-романском стиле придется по вкусу как любителям классики,
         так и поклонникам современного дизайна.</p>
         <a href="#">Читать далее</a>
      </div>
      <div class="news-item">
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
      <div class="about-us-description">
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


@endsection()
