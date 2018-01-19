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

<section class="home-subscribe">
  <h3>Подпишитесь на наши новости</h3>
  <form class="subcribe" action="index.html" method="post">
    <input type="email" name="email" placeholder="Ваша электронная почта"></input>
    <input type="submit" name="submit" value="Подписаться">
  </form>
</section>

<footer class="home-footer">
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
      <h2>Написать нам</h2>
      <hr class="footer-promo-line promo-line-red">
      <form class="footer-feedback-form" action="index.html" method="post">
        <input type="text" name="username" placeholder="Ваше имя">
        <input type="email" name="email" placeholder="Ваша электронная почта">
        <textarea name="message" rows="4" cols="30" placeholder="Ваше сообщение"></textarea>
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


@endsection()
