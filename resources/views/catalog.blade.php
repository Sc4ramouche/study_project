@extends('template.site')

@section('content')

<section class="catalog-links">
  <div class="container">
    <nav class="catalog-navigation">
      <ul class="catalog-list">
        <li><a href="#">Посуда для приготовления</a></li>
        <li><a href="#">Посуда для сервировки</a></li>
        <li><a href="#">Хранение на кухне</a></li>
        <li><a href="#">Кухонная утварь</a></li>
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
  <h2>Подкатегории</h2>
  <p><i class="arrow-down"></i></p>
  <dl class="category-list">
      @foreach ($all_subcategory as $name => $count)
        <a href="#">
        <dt>{{ $name }}</dt>
        <dd>{{ $count }}</dd></a>
      @endforeach
  </dl>

  <div class="catalog-brand">
    <label for="brand">Бренд</label>
    <p><i class="arrow-down"></i></p>
    @foreach($all_brands as $value)
        <input type="checkbox" name="brand" value="Taller">{{ $value->name }}</input>
    @endforeach
  </div>
  <div class="catalog-volume">
    <label for="volume">Объём</label>
    <p><i class="arrow-down"></i></p>
    <input type="radio" name="volume" value="to2">До 2л</input>
    <input type="radio" name="volume" value="from2to5">От 2 до 5л</input>
    <input type="radio" name="volume" value="from5">Более 5л</input>
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

<div class="">
    <h1>HELLO</h1>
    @foreach($products as $value)
        {{ $value->subcategory_name }}
        {{ $value->brand_name }}
        {{ $value->Price }}руб
        <img src="img/{{ $value->pic }}.jpg">
    @endforeach
</div>



@endsection()
