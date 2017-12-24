@extends('template.site')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="{{ asset('js/catalog.js') }}"></script>

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


<!-- Filters group -->
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
  <form class="catalog-filter-form" action="/catalog/filter" method="post">
      <input type="hidden" id="cat_id" value="{{ $category_id }}">
      <input type="hidden" id="sub_id" value="{{ $subcategory_id }}">
  <h2>Подкатегории</h2>
  <p><i class="arrow-down"></i></p>
  <dl class="category-list">
      @foreach ($filters['subcategory'] as $value)
            <a href="/catalog/{{ $category_id }}/{{ $value['sub_id'] }}">
            <dt>{{ $value['sub_name'] }}</dt>
            <dd>{{ $value['sub_count'] }}</dd></a>
       @endforeach
  </dl>

<dl class="category-list">
  <div class="catalog-country">
    <label for="county">Страна</label>
    <p><i class="arrow-down"></i></p>
    @foreach($filters['country'] as $value)
        <br><input type="checkbox" name="country_{{ $value['country_id'] }}" value="{{ $value['country_name'] }}">
            {{ $value['country_name'] }}({{ $value['country_count'] }})
        </input>
    @endforeach
  </div>

  <div class="catalog-brand">
    <label for="brand">Бренд</label>
    <p><i class="arrow-down"></i></p>
    @foreach($filters['brand'] as $value)
        <br><input type="checkbox" name="brand_{{ $value['brand_id'] }}" value="{{ $value['brand_name'] }}">
            {{ $value['brand_name'] }}({{ $value['brand_count'] }})
        </input>
    @endforeach
  </div>

  <div class="catalog-model">
    <label for="model">Модель</label>
    <p><i class="arrow-down"></i></p>
    @foreach($filters['model'] as $value)
        <br><input type="checkbox" name="model_{{ $value['model_id'] }}" value="{{ $value['model_name'] }}">
            {{ $value['model_name'] }}({{ $value['model_count'] }})
        </input>
    @endforeach
  </div>

  <div class="catalog-material">
    <label for="material">Материал</label>
    <p><i class="arrow-down"></i></p>
    @foreach($filters['material'] as $value)
        <br><input type="checkbox" name="material_{{ $value['material_id'] }}" value="{{ $value['material_name'] }}">
             {{ $value['material_name'] }}({{ $value['material_count'] }})
        </input>
    @endforeach
  </div>

  <!-- <div class="catalog-volume">
    <label for="volume">Объём</label>
    <p><i class="arrow-down"></i></p>
    <input type="radio" name="volume" value="to2">До 2л</input>
    <input type="radio" name="volume" value="from2to5">От 2 до 5л</input>
    <input type="radio" name="volume" value="from5">Более 5л</input>
  </div> -->

  <div class="catalog-price">
    <label for="">Цена</label>
    <p><i class="arrow-down"></i></p>
    <br>От<input type="text" id="price_min" name="price_min" value="" placeholder="{{ $filters['price_min'] }}"></input>
    <br>До<input type="text" id="price_max" name="price_max" value="" placeholder="{{ $filters['price_max'] }}"></input>
  </div>
  <!-- <div class="catalog-color">
    <label for="color">Цвет</label>
    <p><i class="arrow-down"></i></p>
    <input type="checkbox" name="color" value="blue">blue</input>
    <input type="checkbox" name="color" value="green">green</input>
    <input type="checkbox" name="color" value="yellow">yellow</input>
    <input type="checkbox" name="color" value="orange">orange</input>
    <input type="checkbox" name="color" value="violet">violet</input>
  </div> -->
  <button type="submit">Применить</button>
  <input type="reset" name="reset" value="Сбросить"></input>
  </form>
</div>

<!-- Товары -->
<div class="products-list">
    <h1>-----------СЕТКА-----------</h1>
    @if(count($products) > 0)
        @foreach($products as $value)
            @if ($value->IsNew)
                NEW
            @endif
            @if ($value->IsLeader)
                HOT
            @endif
            @if ($value->IsRecomend)
                RECOMENDED
            @endif
            {{ $value->type }}
            {{ $value->brand }}
            {{ $value->model}}
            {{ $value->Price }}руб
            <img src="img/{{ $value->pic }}.jpg"><br>
        @endforeach
    @else
        <h1>НОВИНКИ</h1>
    @endif
</div>



@endsection()
