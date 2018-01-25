@extends('template.site')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">
  <ul class="breadcrumb">
    <li><a href="#">Главная</a></li>
    <li>Корзина</li>
  </ul>
</div>

<section class="checkout-page">
  <div class="container">
    <div class="cart-items checkout-items">


    </div>
      <div class="cart-aftermath clearfix">
        <p class="to-pay">Всего:</p>
        <b class="result"></b>
      </div>
      <div class="card-form-submit form-buttons clearfix">
        <button type="button" name="buy" class="continue">Продолжить покупки</button>
        <form action="/checkout">
          <button type="submit" name="add" class="checkout">Оформить заказ</button>
        </form>
        </form>
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

  //Вставка сессий
  $(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var vendoreCodes = $.session.get('VendoreCodes');
    // var vendoreCodes = "175980 175980 175980 5612 12345";
    vendoreCodes = vendoreCodes.split(' ');
    var count = $.session.get("VendoreCount");
    // var count = "1 1 1 1 1";
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
          $('.checkout-page').find('.container').find('.cart-items').append('<div class="container-item checkout-item">' +
                                                '<div class="container-item-image">' +
                                                '<img src="/img/' + data[i]['Picture'] + '" alt="Товар">' +
                                                '</div>' +
                                                '<div class="container-item-description">' +
                                                '<h2>' + data[i]['BrendName'] + ' ' + data[i]['ModelName'] + '</h2><b class="art">арт. ' + data[i]['VendoreCode'] + '</b>' +
                                                '<h4>В наличии</h4>' +
                                                '<b class="price">Цена: ' + data[i]['Price'] + '&#8381;</b>' +
                                                '</div>' +
                                                '<div class="quantity">' +
                                                '<label for="quantity">Количество</label>' +
                                                '<input type="number" min="1" max="9" step="1" value="' + data[i]['Count']  + '" name="quantity">' +
                                                '</div>' +
                                                '<div class="checkout-summ">' +
                                                '<h4>Сумма</h3>' +
                                                '<b div id="Allprice" b>' + data[i]['Price'] * data[i]['Count'] + '&#8381;</div></b>' +
                                                '</div>' +
                                                '</div>');
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

    $('body').on('change', 'input[name=quantity]', function() {
      var counts = []; //для обновления кол-ва каждого товара
      var vendore = []; //для обновления артикулов каждого товара
      var allcounts = 0; //для обновления кол-ва суммы товаров
      var SumPrice = 0; //для обновления суммы всех товаров
      var vendoreCodes = $.session.get('VendoreCodes');
      vendoreCodes = vendoreCodes.split(' ');
      var Items = $('.cart-items');
      newSum = 0;
      i = 0;
      Items.children().each(function(index, elem) {
        count = $(this).find('input[name=quantity]').val();
        cost = $(this).find('.price').text().split(' ')[1];
        art = $(this).find('.art').text().split(' ')[1];
        cost = cost.slice(0, -1);

        newProductPrice = cost * count;
        $(this).find('#Allprice').text(newProductPrice);
        $(this).find('#Allprice').append('&#8381;');
        newSum += newProductPrice;
        if (Number(count) != 0) {
          counts[i] = count; //для обновления кол-чества товара в сессии
          vendore[i] = art;
          allcounts += Number(count);
          SumPrice += Number(count) *  Number(cost);
          i++;
        }
      });
      $('.result').text(newSum);
      $('.result').append('&#8381;');

      stringCount = "";
      stringVendore = "";
      for (var i = 0; i < counts.length; i++)
        if (i == 0) {
          stringCount += counts[i];
          stringVendore += vendore[i];
        }
        else{
          stringCount += ' ' + counts[i];
          stringVendore += ' ' + vendore[i];
        }
      //Обновить данные в сессии
      $.session.set("Price", SumPrice);
      $.session.set("Counts", allcounts);
      $.session.set("VendoreCodes", stringVendore);
      $.session.set("VendoreCount", stringCount);

      //Обновить надпись корзины
      x = allcounts + " товаров на " + SumPrice;
      $('#bucketName').text(x);
      $('#bucketName').append('&#8381;');
    });
  });

</script>
@endsection()
