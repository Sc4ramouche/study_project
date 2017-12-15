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

<div class="catalog-header">
  <p>1-15 из 35</p>
  <label for="product-quanity">Показывать</label>
  <select class="product-quanity" name="product-quanity">
    <option value="1">12 товаров</option>
  </select>
  <label for="product-sort">Сортировать по</label>
  <select class="product-sort" name="product-sort">
    <option value="1">популярности</option>
  </select>
</div>

<div class="catalog-category">
  <form class="catalog-form" action="index.html" method="post">
  <h2>Категория</h2>
  <p><i class="arrow-down"></i></p>
  <dl class="category-list">
    <dt>Наплитная посуда</dt>
    <dd>35</dd>
    <dt>Формы для выпечки</dt>
    <dd>10</dd>
    <dt>Кухонные инструменты</dt>
    <dd>6</dd>
    <dt>Ножи и разделочные доски</dt>
    <dd>30</dd>
    <dt>Предметы сервировки</dt>
    <dd>11</dd>
    <dt>Системы хранения</dt>
    <dd>11</dd>
    <dt>Наборы посуды</dt>
    <dd>18</dd>
    <dt>Аксессуары для декора</dt>
    <dd>15</dd>
    <dt>Посуда для напитков</dt>
    <dd>8</dd>
    <dt>Детская посуда</dt>
    <dd>16</dd>
    <dt>Одноразовая посуда</dt>
    <dd>18</dd>
    <dt>Столовые приборы</dt>
    <dd>30</dd>
    <dt>Крышки</dt>
    <dd>17</dd>
  </dl>
  <div class="catalog-brand">
    <label for="brand">Бренд</label>
    <p><i class="arrow-down"></i></p>
    <input type="checkbox" name="brand" value="Taller">Taller</input>
    <input type="checkbox" name="brand" value="Nadoba">Nadoba</input>
    <input type="checkbox" name="brand" value="Rondel">Rondel</input>
  </div>
  <div class="catalog-volume">
    <label for="volume">Объём</label>
    <p><i class="arrow-down"></i></p>
    <input type="checkbox" name="volume" value="to2">До 2л</input>
    <input type="checkbox" name="volume" value="from2to5">От 2 до 5л</input>
    <input type="checkbox" name="volume" value="from5">Более 5л</input>
  </div>
  <div class="catalog-material">
    <label for="material">Материал</label>
    <p><i class="arrow-down"></i></p>
    <input type="checkbox" name="material" value="wood">Дерево</input>
    <input type="checkbox" name="material" value="glass">Стекло</input>
    <input type="checkbox" name="material" value="ceramics">Керамика</input>
  </div>
  <div class="catalog-material">
    <label for="price">Цена</label>
    <p><i class="arrow-down"></i></p>
    <input type="range" name="price" value="price" min="400" max="10000" list="tickmarks" step="10">
    <datalist id="tickmarks">
      <option value="400" label="400">
      <option value="5000" label="5000">
      <option value="10000" label="10000">
    </datalist>
  </div>
  <div class="catalog-color">
    <label for="color">Цвет</label>
    <p><i class="arrow-down"></i></p>
    <input type="checkbox" name="color" value="blue">blue</input>
    <input type="checkbox" name="color" value="green">green</input>
    <input type="checkbox" name="color" value="yellow">yellow</input>
    <input type="checkbox" name="color" value="orange">orange</input>
    <input type="checkbox" name="color" value="violet">violet</input>
  </div>
  <input type="submit" name="submit" value="Применить"></input>
  <input type="reset" name="reset" value="Сбросить"></input>
  </form>
</div>

@endsection()
