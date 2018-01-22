@extends('template.site')

@section('content')

<div class="container">
  <ul class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li>Новости</li>
  </ul>
</div>


<h1 class="timeline-description">Этапы получения товара</h1>
<div class="timeline container">
  <div class="timeline-container left">
    <div class="timeline-content" id="adding">
      <h2 class="timeline-header">1 этап</h2>
      <p>Добавление выбранного товара <br> из каталога товаров в корзину</p>
    </div>
  </div>

  <div class="timeline-container right">
    <div class="timeline-content" id="delivery">
      <h2 class="timeline-header">2 этап</h2>
      <p>Выбор способа доставки товара:</p>
      <ul>
        <li>Самовывоз</li>
        <li>Курьерская доставка</li>
        <li>Отправка почтой</li>
      </ul>
    </div>
  </div>

    <div class="timeline-container left">
      <div class="timeline-content" id="payment">
        <h2 class="timeline-header">3 этап</h2>
        <p>Выбор способа оплаты товара:</p>
        <ul>
          <li>Оплата наличными</li>
          <li>Банковской картой</li>
          <li>Электронный платёж</li>
        </ul>
      </div>
    </div>

    <div class="timeline-container right">
      <div class="timeline-content" id="receiving">
        <h2 class="timeline-header">4 этап</h2>
        <p>Получение выбранного товара</p>
      </div>
    </div>

</div>
<a href="/cart" class="make-order">Оформить заказ</a>

@endsection()
