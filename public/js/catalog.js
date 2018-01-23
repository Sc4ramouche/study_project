$(document).ready(function(){


    var sort = {
        'name': 0,
        'type': 0,
    };

    //Число товаров на странице
    var take_count = 12; //products_on_page
    var page_number = 1;
    var skip_count = 0;
    var flag_up_filter = false;
    //Сортировка
    $('#sort').on('change', function(){
        sort.name = $('#sort option:selected').data('sort-name');
        sort.type = $('#sort option:selected').data('sort-type');
        $('#set_filter').submit();
    });

    function reset_pagination() {
        page_namber = 1;
        skip_count = 0;
        //Получение числа продуктов для отображения на одной странице
        take_count = $('#list-count option:selected').val();
        //Получение числа всех продуктов
        var products_count = $('#products-count').text();
        var page_count = Math.ceil(products_count / take_count); //Число страниц
        $('.catalog-pages').empty();
        var code;
        for(let i = 1; i <=  page_count; i++) {
                if(i === 1) {
                    code = '<button type="button" name="button" class="switch-page switch-active">' + i + '</button>';
                } else {
                    code = '<button type="button" name="button" class="switch-page">' + i + '</button>';
                }
                $('.catalog-pages').append(code);
        }
    }

    //Измененеи количества отображения товаров на странице католога
    $('#list-count').on('change', function(){

        if(!flag_up_filter) {
            reset_pagination();
        }
        flag_up_filter = true;
        $('#set_filter').submit();
    });

    //Переключение страниц каталога
    $('.catalog-pages').on('click', '.switch-page', function(){
        page_number = $(this).text();
        skip_count = take_count * page_number - take_count;
        flag_up_filter = true;
        $('#set_filter').submit();
        $('.switch-active').removeClass('switch-active');
        $(this).addClass('switch-active');
        page_number = 1;
    });

    $('.catalog-filter-form').on('submit', function(evt){
        //alert('2 - ' + take_count);
        if(!flag_up_filter){
            take_count = 12; //products_on_page
            page_number = 1;
            skip_count = 0;
            reset_pagination();
        }

        evt.preventDefault();
        var action = $(this).attr('action');
        var country = [];
        var brand = [];
        var model = [];
        var material = [];

        var cat_id = $('#cat_id').val();
        var sub_id = $('#sub_id').val();


        $(".catalog-country  input:checked").each(function(element){
            country.push($(this).val());
        });

        $(".catalog-brand input:checked").each(function(element){
            brand.push($(this).val());
        });
        $(".catalog-model input:checked").each(function(element){
            model.push($(this).val());
        });
        $(".catalog-material input:checked").each(function(element){
            material.push($(this).val());
        });
        var data = {
            'country': country,
            'brand': brand,
            'model': model,
            'material': material,
            'price_min': $('#price_min').val(),
            'price_max': $('#price_max').val(),
        };
        //data.push(country);

        console.log(data);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: action,
            type: 'POST',
            data: {_token: CSRF_TOKEN,
                    'cat_id': cat_id,
                    'sub_id': sub_id,
                    'sort': JSON.stringify(sort),
                    'skip_count': skip_count,
                    'take_count': take_count,
                    'page_number': page_number,
                    'data': JSON.stringify(data)
                  },
            success: function(data){
                if(data.success){
                    console.log(data);
                    //$('.products-count').text(data.result.length);
                    // if(!flag_up_filter) {
                    //     reset_pagination();
                    // }
                    //Вывод отфильтрованных товаров
                    var rez = data.result;
                    $('.catalog-grid').empty();
                    rez.forEach(function(value, i, rez){
                        var card = '' +
                          '<div class="catalog-grid-item">' +
                            '<div class="grid-item-img">' +
                              '<img src="/img/' + value.pic + '.jpg" alt="image">' +
                            '</div>' +
                            '<a href="/productcard/'+ value.VENDOR_CODE +'">' +
                            '<h4 class="grid-item-name">' + value.type + ' ' + '<span class="brand-name">'+ value.brand + ' ' + value.model + '</span></h4>' +
                            '</a>' +
                            '<hr class="promo-line">' +
                            '<b class="grid-item-price">' + value.Price + '&#8381;</b>' +
                          '</div>';
                        $('.catalog-grid').append(card);

                    });
                } else {
                    console.log(data);
                    alert('bad');
                }
            },
            error: function(data){
                console.log(data);
                alert('err');
            },

        });
        flag_up_filter = false;
    });

});
