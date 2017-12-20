@extends('template.site')

@section('content')

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
          <input type="text" name="username" placeholder="ФИО получателя">
        </div>
        <div class="form-phone">
          <label for="phone">
            <input type="tel" name="phone" placeholder="+7 (900) 000-00-00" pattern="[\+]\d{1}\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}" minlength="18" maxlength="18" />
            <span class="form__error">Номер телефона в формате +7 (123) 456-78-90</span>
          </label>
        </div>
        <div class="form-email">
          <label for="email"></label>
          <input type="email" name="email" placeholder="Email">
        </div>
        <div class="form-adress">
          <label for="adress"></label>
          <input type="text" name="adress" placeholder="Адрес">
        </div>
        <div class="form-payment form-select">
          <label for="payment"></label>
          <select name="payment">
            <option value="" disabled selected hidden>Способ оплаты</option>
            <option value="hurr">1</option>
            <option value="first">2</option>
          </select>
        </div>
        <div class="form-delivery form-select">
          <label for="delivery"></label>
          <select name="delivery">
            <option value="" disabled selected hidden>Способ доставки</option>
            <option>Самовывоз</option>
            <option>Доставка курьеров</option>
            <option>Доставка почтой</option>
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
        <div class="container-item-image">
          <img src="img/nadoba-augusta.jpg" alt="Товар">
        </div>
        <div class="container-item-description">
          <h4>Кастрюля Nadoba Augusta</h4><b class="art">арт. 950493</b><b class="quantity">(4)</b>
          <hr class="promo-line-red cart-page-line">
          <b class="price">2072&#8381;</b>
        </div>
      </div>
      <div class="cart-aftermath">
        <p class="to-pay">К оплате:</p>
        <b class="result">8288&#8381;</b>
      </div>
    </div>
  </div>
</section>

@endsection()
