@extends('template.site')

@section('content')

<div class="container">
  <ul class="breadcrumb">
    <li><a href="#">Главная</a></li>
    <li>Корзина</li>
  </ul>
</div>

<section class="checkout-page">
  <div class="container">
    <div class="cart-items checkout-items">
      <div class="container-item checkout-item">
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h2>Кастрюля Nadoba Augusta</h2><b class="art">арт. 950493</b>
          <h4>В наличии</h4>
          <b class="price">Цена: 2072&#8381;</b>
        </div>
        <div class="quantity">
          <label for="quantity">Количество</label>
          <input type="number" min="1" max="9" step="1" value="1" name="quantity">
        </div>
        <div class="checkout-summ">
          <h4>Сумма</h4>
          <b class="price">2072&#8381;</b>
        </div>
      </div>
      <div class="container-item checkout-item">
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h2>Кастрюля Nadoba Augusta</h2><b class="art">арт. 950493</b>
          <h4>В наличии</h4>
          <b class="price">Цена: 2072&#8381;</b>
        </div>
        <div class="quantity">
          <label for="quantity">Количество</label>
          <input type="number" min="1" max="9" step="1" value="1" name="quantity">
        </div>
        <div class="checkout-summ">
          <h4>Сумма</h4>
          <b class="price">2072&#8381;</b>
        </div>
      </div>
      <div class="container-item checkout-item">
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h2>Кастрюля Nadoba Augusta</h2><b class="art">арт. 950493</b>
          <h4>В наличии</h4>
          <b class="price">Цена: 2072&#8381;</b>
        </div>
        <div class="quantity">
          <label for="quantity">Количество</label>
          <input type="number" min="1" max="9" step="1" value="1" name="quantity">
        </div>
        <div class="checkout-summ">
          <h4>Сумма</h4>
          <b class="price">2072&#8381;</b>
        </div>
      </div>
      <div class="container-item checkout-item">
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h2>Кастрюля Nadoba Augusta</h2><b class="art">арт. 950493</b>
          <h4>В наличии</h4>
          <b class="price">Цена: 2072&#8381;</b>
        </div>
        <div class="quantity">
          <label for="quantity">Количество</label>
          <input type="number" min="1" max="9" step="1" value="1" name="quantity">
        </div>
        <div class="checkout-summ">
          <h4>Сумма</h4>
          <b class="price">2072&#8381;</b>
        </div>
      </div>
      <div class="cart-aftermath clearfix">
        <p class="to-pay">Всего:</p>
        <b class="result">8288&#8381;</b>
      </div>
      <div class="card-form-submit form-buttons clearfix">
        <button type="button" name="buy" class="continue">Продолжить покупки</button>
        <button type="button" name="add" class="checkout">Оформить заказ</button>
      </div>
    </div>
  </div>
</section>

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
