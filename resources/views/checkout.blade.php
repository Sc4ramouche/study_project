@extends('template.site')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

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
    <li><a href="#">Корзина</a></li>
    <li>Оформление заказа</li>
  </ul>
</div>

<section class="cart-page">
  <div class="container">
    <h3>Заполните форму или <button id="authBtn">авторизируйтесь</button></h3>
    <div id="authModal" class="modal">
      <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div class="modal-auth">
          <div class="modal-social">
            <p>Войти через:</p>
            <div class="social-vk social-button">
              <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
            </div>
            <div class="social-od social-button">
              <a href="#"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
            </div>
            <div class="social-fb social-button">
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
            <div class="social-in social-button">
              <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="modal-form-container">
            <form class="modal-form" action="index.html" method="post">
              <div class="modal-username">
                <label for="username"></label>
                <input type="text" name="username" placeholder="ФИО">
              </div>
              <div class="modal-email">
                <label for="email"></label>
                <input type="email" name="email" placeholder="Email">
              </div>
              <div class="modal-password">
                <label for="password"></label>
                <input type="password" name="password" placeholder="Придумайте пароль">
              </div>
              <div class="form-acceptance">
                <label class="checkbox-container">
                  <input type="checkbox">Даю согласие на обработку персональных данных.</input>
                  <span class="cart-checkbox" unchecked></span>
                </label>
              </div>
              <div class="form-acceptance">
                <label class="checkbox-container">
                  <input type="checkbox">Хочу получать интересные предложения от Дом Посуды</input>
                  <span class="cart-checkbox" unchecked></span>
                </label>
              </div>
              <div class="modal-submit">
                <input type="submit" value="Зарегистрироваться">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container cart-page-container">
    <div class="container-form">
      <form class="cart-form" action="index.html" method="post">
        <div class="form-username">
          <label for="username"></label>
          <input type="text" name="username" placeholder="ФИО получателя" value="{{ $Name }}" id="NameOrder">
        </div>
        <div class="form-phone">
          <label for="phone">
            <input type="tel" name="phone" placeholder="+7 (900) 000-00-00" pattern="[\+]\d{1}\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}" minlength="18" maxlength="18" value="{{ $Telephone }}" id="TelephoneOrder"/>
            <span class="form__error">Номер телефона в формате +7 (123) 456-78-90</span>
          </label>
        </div>
        <div class="form-email">
          <label for="email"></label>
          <input type="email" name="email" placeholder="Email" value="{{ $Email }}" id="EmailOrder">
        </div>
        <div class="form-adress">
          <label for="adress"></label>
          <input type="text" name="adress" placeholder="Адрес" value="{{ $Adress }}" id="AdressOrder">
        </div>
        <div class="form-payment form-select">
          <label for="payment"></label>
          <select name="payment" id="PaymentOrder">
            <option value="" disabled selected hidden>Способ оплаты</option>
            <option value="1">Наличный расчет</option>
            <option value="2">Безналичные расчёт</option>
          </select>
        </div>
        <div class="form-delivery form-select">
          <label for="delivery"></label>
          <select name="delivery" id="DeliveryOrder">
            <option value="" disabled selected hidden>Способ доставки</option>
            <option value="1">Самовывоз</option>
            <option value="2">Доставка курьеров</option>
            <option value="3">Доставка почтой</option>
          </select>
        </div>
        <div class="form-acceptance">
          <label class="checkbox-container">
            <input type="checkbox">Даю согласие на обработку персональных данных.</input>
            <span class="cart-checkbox" unchecked></span>
          </label>
        </div>
        <div class="card-form-submit form-buttons">
          <button type="button" name="buy" class="continue">Продолжить покупки</button>
          <button type="button" name="add" class="checkout">Оформить заказ</button>
        </div>
      </form>
    </div>
    <div class="cart-items">
      <div class="container-item">


      </div>
      <div class="cart-aftermath">
        <p class="to-pay">К оплате:</p>
        <b class="result">0</b>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if (($.session.get('VendoreCodes') != undefined) && ($.session.get('VendoreCodes') != '')) {
    var vendoreCodes = $.session.get('VendoreCodes');
    vendoreCodes = vendoreCodes.split(' ');
    var count = $.session.get("VendoreCount");
    count = count.split(' ');
    $.ajax({
      type: "GET",
      url: "/admin/GetProductsCart",
      data: {_token: CSRF_TOKEN, VendoreCodeArray: vendoreCodes, CountArray: count},
      success: function(data) {
        data = JSON.parse(data);
        sum = 0;
        result = "";
        for (var i = 0; i < data.length; i++) {
          $('.container-item').append('<div class="container-item-image">' +
                                        '<img src="/img/' + data[i]['Picture'] + '" alt="Товар">' + 
                                      '/<div>');
          $('.container-item').append('<div class="container-item-description">' +
                                        '<h4>' + data[i]['BrendName'] + ' ' + data[i]['ModelName'] + '</h4>' +
                                        '<b class="art">арт. '+ data[i]['VendoreCode'] + '</b><b class="quantity">(' + data[i]['Count'] + ')</b>' +
                                        '<hr class="promo-line-red cart-page-line">' +
                                      '<b class="price">' + data[i]['Price'] * data[i]['Count'] + '&#8381;</b></div>');
          sum += data[i]['Count'] * data[i]['Price'];
        }
        result += sum;
        $('.result').text(result);
        $('.result').append('&#8381;');
      },
      error: function(data) {
        alert("Ошибка при отправке запроса на сервер!");
      }
    });
  }


      $('.checkout').bind('click', function() {
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      if (( $('#NameOrder').val() != '' ) && ( $('#TelephoneOrder').val() != '' ) && ( $('#EmailOrder').val() != '') &&
            ( $('#AdressOrder').val() != '' ) && ( $('#PaymentOrder').val() != null ) &&
            ( $('#DeliveryOrder').val() != null )) {

          if (($.session.get('VendoreCodes') != undefined) && ($.session.get('VendoreCodes') != '')) {
          var vendoreCodes = $.session.get('VendoreCodes');
          vendoreCodes = vendoreCodes.split(' ');
          var vendoreCount = $.session.get('VendoreCount');
          vendoreCount = vendoreCount.split(' ');
          var date = new Date();
          if (date.getMonth() < 9)
            var stringDate = date.getDate() + " 0" + (date.getMonth() + 1) + " " + date.getFullYear();
          else
            var stringDate = date.getDate() + " " + (date.getMonth() + 1) + " " + date.getFullYear();
          $.ajax({
            type: "POST",
            url: "/admin/NewOrder",
            data: {_token: CSRF_TOKEN, VendoreCodeArray: vendoreCodes, CountArray: vendoreCount, Email: $('#EmailOrder').val(),
                    Telephone: $('#TelephoneOrder').val(), Name: $('#NameOrder').val(), Adress: $('#AdressOrder').val(),
                    ID_Payment: $('#PaymentOrder').val(), ID_Delivery: $('#DeliveryOrder').val(), Date: stringDate,
                    Price: $('.result').text().slice(0, -1)},
            success: function(data) {
              str = data['orderStatus'];
              if (str == "Заказ успешно оформлен!") {
                alert(data['orderStatus']);
                $.session.clear();
                $('.container-item').empty();
                $('.result').empty();
                $('.result').append('0');
              }
              else {
                alert(data['orderStatus']);
              }
            },
            error: function(data) {
              alert("Ошибка при отправке запроса на сервер!");
            }
          });
        }
        else
          alert("Товара в корзине нет!");

      }
      else {
        alert("Данные заполнены не полностью!");
      }
    });

  });


</script>
<!--
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h4>Кастрюля Nadoba Augusta</h4><b class="art">арт. 950493</b><b class="quantity">(4)</b>
          <hr class="promo-line-red cart-page-line">
          <b class="price">2072&#8381;</b>
        </div> -->

@endsection()
