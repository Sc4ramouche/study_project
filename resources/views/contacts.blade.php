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
    <li>Контакты</li>
  </ul>
</div>

<section class="contacts-page">
  <div class="container contacts-container">
    <div class="contact-spb contact">
      <p class="contact-adress">г. Санкт-Петербург <br>
      Малый пр., д. 42, м. "Чкаловская" </p>
      <p class="contacts-time">пн-пт с 09:00 до 18:00</p>
      <a href="tel:88129341741" class="contacts-phone">+7 (812) 934-17-41</a>
    </div>

    <div class="contact-vn contact">
      <p class="contact-adress">г. Великий Новгород <br>
      ул. Бол. Санкт-Петербургская, д. 25 </p>
      <p class="contacts-time">пн-пт с 10:00 до 18:00</p>
      <a href="tel:88162288224" class="contacts-phone">+7 (8162) 288-224</a>
    </div>
  </div>
</section>

<section class="contacts-map">
  <div class="container">
    <div class="contacts-card">
      <h2>Контакты</h2>
      <hr class="promo-line-red">
      <h3>Центральный офис продаж <br>«ДОМ ПОСУДЫ»</h3>
      <p class="contact-adress">г. Санкт-Петербург <br>
      Дачный пр., д. 19 м. "Пр. Ветеранов"</p>
      <a href="#" class="contacts-email">info@domposudi.com</a>
      <p class="contacts-time">пн-пт с 09:00 до 18:00</p>
      <a href="https://vk.com/domposudi" class="contacts-vk">https://vk.com/domposudi</a>
      <a href="tel:88129341741" class="contacts-phone">+7 (812) 934-17-41</a>
      <a href="#" class="contacts-to-catalog">Каталог Товаров</a>
    </div>
  </div>
</section>

@endsection()
