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

<div class="container">
  <ul class="breadcrumb">
    <li><a href="#">Главная</a></li>
    <li>Каталог товаров</li>
  </ul>
</div>

<section>
  <div class="container catalog-page-container">
    <div class="catalog-interface-container">
      <div class="catalog-category">
        <form class="catalog-filter-form" action="/catalog/filter" method="post">
          <input type="hidden" id="cat_id" value="{{ $category_id }}">
          <input type="hidden" id="sub_id" value="{{ $subcategory_id }}">
          <h2>Категория</h2>
          <dl class="category-list">
            @foreach ($filters['subcategory'] as $value)
            <a href="/catalog/{{ $category_id }}/{{ $value['sub_id'] }}">
              <dt>{{ $value['sub_name'] }}</dt>
              <dd>{{ $value['sub_count'] }}</dd></a>
              @endforeach
            </dl>

            <dl class="category-list">
              <div class="catalog-country">
                <h2>Страна</h2>
                @foreach($filters['country'] as $value)
                <div class="value-container">
                  <input type="checkbox" name="country_{{ $value['country_id'] }}" value="{{ $value['country_name'] }}"></input>
                  <label for="country_{{ $value['country_id'] }}">{{ $value['country_name'] }}({{ $value['country_count'] }})</label>
                </div>
                @endforeach
              </div>

              <div class="catalog-brand">
                <h2>Бренд</h2>
                @foreach($filters['brand'] as $value)
                <div class="value-container">
                  <input type="checkbox" name="brand_{{ $value['brand_id'] }}" value="{{ $value['brand_name'] }}"></input>
                  <label for="brand_{{ $value['brand_id'] }}">{{ $value['brand_name'] }}({{ $value['brand_count'] }})</label>
                </div>
                @endforeach
              </div>

              <div class="catalog-model">
                <h2>Модель</h2>
                @foreach($filters['model'] as $value)
                <div class="value-container">
                  <input type="checkbox" name="model_{{ $value['model_id'] }}" value="{{ $value['model_name'] }}"></input>
                  <label for="model_{{ $value['model_id'] }}">{{ $value['model_name'] }}({{ $value['model_count'] }})</label>
                </div>
                @endforeach
              </div>

              <div class="catalog-material">
                <h2>Материал</h2>
                @foreach($filters['material'] as $value)
                <div class="value-container">
                  <input type="checkbox" name="material_{{ $value['material_id'] }}" value="{{ $value['material_name'] }}"></input>
                  <label for="material_{{ $value['material_id'] }}">{{ $value['material_name'] }}({{ $value['material_count'] }})</label>
                </div>
                @endforeach
              </div>

              <!-- <div class="catalog-volume">
              <h2>Объём</h2>
              <input type="radio" name="volume" value="to2">До 2л</input>
              <input type="radio" name="volume" value="from2to5">От 2 до 5л</input>
              <input type="radio" name="volume" value="from5">Более 5л</input>
            </div> -->

            <div class="catalog-price">
              <h2>Цена</h2>
              <!--Рабочии прайсы-->
              <br>От<input type="text" id="price_min" name="price_min" value="" placeholder="{{ $filters['price_min'] }}"></input>
              <br>До<input type="text" id="price_max" name="price_max" value="" placeholder="{{ $filters['price_max'] }}"></input> <br>
              <!-- Прайсы владика -->
              <div class="catalog-slider">
                <div>
                  <label for="amount"></label>
                  <input type="text" id="amount" readonly style="border:0; font-weight:bold;">
                </div>
                <div id="slider-range"></div>
              </div>
            </div>

            <div class="card-form-color">
              <h2>Цвет</h2>
              <div class="card-form-container">
                <label class="checkmark-container">
                  <input type="radio" name="color" checked>
                  <span class="card-checkmark" id="blue"></span>
                </label>
              </div>

              <div class="card-form-container">
                <label class="checkmark-container">
                  <input type="radio" name="color">
                  <span class="card-checkmark" id="salad"></span>
                </label>
              </div>

              <div class="card-form-container">
                <label class="checkmark-container">
                  <input type="radio" name="color">
                  <span class="card-checkmark" id="yellow"></span>
                </label>
              </div>

              <div class="card-form-container">
                <label class="checkmark-container">
                  <input type="radio" name="color">
                  <span class="card-checkmark" id="orange"></span>
                </label>
              </div>

              <div class="card-form-container">
                <label class="checkmark-container">
                  <input type="radio" name="color">
                  <span class="card-checkmark" id="violet"></span>
                </label>
              </div>
            </div>

            <input type="submit" name="submit" value="Применить"></input>
            <input type="reset" name="reset" value="Сбросить"></input>
          </form>
        </div>

        <div class="catalog-visited">
          <h3>Последние просмотренные</h3>
          <div class="visited-container">
            <div class="visited-item">
              <div class="visited-img">
                <img src="../img/visited-item-1.png" alt="alo">
              </div>
              <div class="visited-info">
                <h4 class="visited-name">Кастрюля Rondell</h4>
                <hr class="promo-line-red">
                <b class="visited-price">3100&#8381;</b>
              </div>
            </div>
            <div class="visited-item">
              <div class="visited-img">
                <img src="../img/visited-item-1.png" alt="alo">
              </div>
              <div class="visited-info">
                <h4 class="visited-name">Ковш с крышкой Rondell Stern</h4>
                <hr class="promo-line-red">
                <b class="visited-price">1930&#8381;</b>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="catalog-goods-container">
        <div class="catalog-header">
          <div class="catalog-amount">
            <p>1-15 из 35</p>
          </div>
          <div class="catalog-show">
            <label for="product-quanity">Показывать</label>
            <select class="product-quanity" name="product-quanity">
              <option value="1">12 товаров</option>
            </select>
          </div>
          <div class="catalog-sort">
            <label for="product-sort">Сортировать по</label>
            <select class="product-sort" name="product-sort">
              <option value="1">популярности</option>
            </select>
          </div>
        </div>

        <div class="catalog-grid">
          <!-- <div class="catalog-grid-item">
            <div class="grid-item-img">
              <img src="../img/catalog.jpg" alt="image">
            </div>
            <h4 class="grid-item-name">Кастрюля <span class="brand-name">Nadoba Augusta</span></h4>
            <hr class="promo-line">
            <b class="grid-item-price">1 930&#8381;</b>
          </div> -->


      </div>
      <div class="catalog-footer">
        <div class="catalog-amount">
          <p>1-15 из 35</p>
        </div>
        <div class="catalog-pages">
          <button type="button" name="button" class="switch-page switch-active">1</button>
          <button type="button" name="button" class="switch-page">2</button>
          <button type="button" name="button" class="switch-page">3</button>
        </div>
        <div class="catalog-show-all">
          <button type="button" name="button" class="show-all">Показать всё</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 500,
    values: [ 75, 300 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
  });
  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
} );
</script>

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
  <img src="../img/{{ $value->pic }}.jpg"><br>
  @endforeach
  @else
  <h1>Новинки</h1>
  @endif
</div>


@endsection()
