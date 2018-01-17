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
    <li><a href="#">Главная</a></li>
    <li>Личный кабинет</li>
  </ul>
</div>

<section  class="account-page">
  <div class="container account-container">
    <div class="user-navigation">
      <div class="user-image">
        <figure>
          <img src="../img/account-user.png" alt="Изображение пользователя">
          <figcaption>Пользователь</figcaption>
        </figure>
      </div>
      <div class="user-buttons">
        <div class="catalog-tab">
          <button class="tablinks" onclick="openSection(event, 'login')" id="defaultOpen">Login</button>
          <button class="tablinks" onclick="openSection(event, 'personalInfo')">Персональные данные</button>
          <button href="#" class="tablinks" onclick="location.href='http://localhost/cart';">Корзина</button>
          <button class="tablinks" onclick="openSection(event, 'purchaseHistory')">История заказов</button>
          <button class="tablinks">Выход</button>
        </div>
      </div>
    </div>
    <div class="user-info">
      <div id="login" class="tabcontent">
        <h4>Вход в личный кабинет</h4>
        <h3>Войти или<button id="authBtn">зарегистрироваться</button></h3>
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
        <form class="account-login-form" role="form" method="POST" action="{{ url('/account/login') }}">
            {{ csrf_field() }}
            <label for="email"></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Электронная почта"><br>

            <label for="password"></label>
            <input id="password" type="password"name="password" required placeholder="Пароль"><br>

            <div class="form-acceptance">
              <label class="checkbox-container">
                <input type="checkbox" name="remeber" {{ old('remember') ? 'checked' : ''}}>Запомнить меня</input>
                <span class="cart-checkbox" unchecked></span>
              </label>
            </div>

            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Запомнить
            </label>

            <button type="submit">
                Войти
            </button>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                Забыли пароль?
            </a>
        </form>
      </div>


      <div id="personalInfo" class="personal-info tabcontent">
        <h4>Персональные данные</h4>
        <form class="account-personal" action="index.html" method="post">
            <div class="account-secondname">
              <label for="secondname"></label>
              <input type="text" name="secondname" placeholder="Фамилия">
            </div>
            <div class="account-firstname">
              <label for="firstname"></label>
              <input type="text" name="firstname" placeholder="Имя">
            </div>
            <div class="account-email">
              <label for="email"></label>
              <input type="email" name="email" placeholder="Электронная почта">
            </div>
            <div class="form-phone">
              <label for="phone">
                <input type="tel" name="phone" placeholder="+7 (900) 000-00-00" pattern="[\+]\d{1}\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}" minlength="18" maxlength="18" />
                <span class="form__error">Номер телефона в формате +7 (123) 456-78-90</span>
              </label>
            </div>
            <div class="account-date clearfix">
              <div class="day">
                <label for="day"></label>
                <select class="select-day" name="day">
                   <option valur="placeholder" disabled selected hidden>День</option>
                   <option value="01">01</option>
                   <option value="02">02</option>
                   <option value="03">03</option>
                   <option value="04">04</option>
                   <option value="05">05</option>
                   <option value="06">06</option>
                   <option value="07">07</option>
                   <option value="08">08</option>
                   <option value="09">09</option>
                   <option value="10">10</option>
                   <option value="11">11</option>
                   <option value="12">12</option>
                   <option value="13">13</option>
                   <option value="14">14</option>
                   <option value="15">15</option>
                   <option value="16">16</option>
                   <option value="17">17</option>
                   <option value="18">18</option>
                   <option value="19">19</option>
                   <option value="20">20</option>
                   <option value="21">21</option>
                   <option value="22">22</option>
                   <option value="23">23</option>
                   <option value="24">24</option>
                   <option value="25">25</option>
                   <option value="26">26</option>
                   <option value="27">27</option>
                   <option value="28">28</option>
                   <option value="29">29</option>
                   <option value="30">30</option>
                   <option value="31">31</option>
                </select>
              </div>
              <div class="month">
                <select name="dob-month" id="dob-month">
                  <option value="" disabled selected hidden>Месяц</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="03">03</option>
                  <option value="04">04</option>
                  <option value="05">05</option>
                  <option value="06">06</option>
                  <option value="07">07</option>
                  <option value="08">08</option>
                  <option value="09">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
              <div class="year">
                <select name="dob-year" id="dob-year">
                  <option value="" disabled selected hidden>Год</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                  <option value="2009">2009</option>
                  <option value="2008">2008</option>
                  <option value="2007">2007</option>
                  <option value="2006">2006</option>
                  <option value="2005">2005</option>
                  <option value="2004">2004</option>
                  <option value="2003">2003</option>
                  <option value="2002">2002</option>
                  <option value="2001">2001</option>
                  <option value="2000">2000</option>
                  <option value="1999">1999</option>
                  <option value="1998">1998</option>
                  <option value="1997">1997</option>
                  <option value="1996">1996</option>
                  <option value="1995">1995</option>
                  <option value="1994">1994</option>
                  <option value="1993">1993</option>
                  <option value="1992">1992</option>
                  <option value="1991">1991</option>
                  <option value="1990">1990</option>
                  <option value="1989">1989</option>
                  <option value="1988">1988</option>
                  <option value="1987">1987</option>
                  <option value="1986">1986</option>
                  <option value="1985">1985</option>
                  <option value="1984">1984</option>
                  <option value="1983">1983</option>
                  <option value="1982">1982</option>
                  <option value="1981">1981</option>
                  <option value="1980">1980</option>
                  <option value="1979">1979</option>
                  <option value="1978">1978</option>
                  <option value="1977">1977</option>
                  <option value="1976">1976</option>
                  <option value="1975">1975</option>
                  <option value="1974">1974</option>
                  <option value="1973">1973</option>
                  <option value="1972">1972</option>
                  <option value="1971">1971</option>
                  <option value="1970">1970</option>
                  <option value="1969">1969</option>
                  <option value="1968">1968</option>
                  <option value="1967">1967</option>
                  <option value="1966">1966</option>
                  <option value="1965">1965</option>
                  <option value="1964">1964</option>
                  <option value="1963">1963</option>
                  <option value="1962">1962</option>
                  <option value="1961">1961</option>
                  <option value="1960">1960</option>
                  <option value="1959">1959</option>
                  <option value="1958">1958</option>
                  <option value="1957">1957</option>
                  <option value="1956">1956</option>
                  <option value="1955">1955</option>
                  <option value="1954">1954</option>
                  <option value="1953">1953</option>
                  <option value="1952">1952</option>
                  <option value="1951">1951</option>
                  <option value="1950">1950</option>
                  <option value="1949">1949</option>
                  <option value="1948">1948</option>
                  <option value="1947">1947</option>
                  <option value="1946">1946</option>
                  <option value="1945">1945</option>
                  <option value="1944">1944</option>
                  <option value="1943">1943</option>
                  <option value="1942">1942</option>
                  <option value="1941">1941</option>
                  <option value="1940">1940</option>
                  <option value="1939">1939</option>
                  <option value="1938">1938</option>
                  <option value="1937">1937</option>
                  <option value="1936">1936</option>
                  <option value="1935">1935</option>
                  <option value="1934">1934</option>
                  <option value="1933">1933</option>
                  <option value="1932">1932</option>
                  <option value="1931">1931</option>
                  <option value="1930">1930</option>
                </select>
              </div>
            </div>
            <div class="account-save">
              <input type="sumbit" name="button" class="account-save-btn" value="Сохранить">
            </div>
            <div class="account-password-change">
              <div class="password-change-container">
                <input type="password" name="old-password" placeholder="Старый пароль">
              </div>
              <div class="account-password-change">
                <input type="password" name="new-password" placeholder="Новый пароль">
              </div>
              <div class="account-password-change">
                <input type="password" name="new-password" placeholder="Повторите новый пароль">
              </div>
              <div class="password-change">
                <input type="sumbit" name="button" class="password-change-btn" value="Изменить">
              </div>
            </div>
        </form>
      </div>

      <div id="purchaseHistory" class="purchase-history tabcontent">
        <h4>История покупок</h4>
        <div class="history-container">
          <div class="history-item checkout-item">
            <div class="container-item">
              <img src="../img/nadoba-augusta.jpg" alt="Товар">
            </div>
            <div class="container-item-description">
              <h2>Кастрюля Nadoba Augusta</h2><b class="art">арт. 950493</b>
              <h4>В наличии</h4>
              <b class="price">Цена: 2072&#8381;</b>
            </div>
            <div class="container-item-date">
              <h4>Дата покупки</h4>
              <time datetime="2017-07-20">20.07.2017</time>
            </div>
            <div class="container-item-summ">
              <h4>Сумма</h4>
              <b>2072&#8381;</b>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection
