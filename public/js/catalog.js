$(document).ready(function(){


    $('.catalog-filter-form').on('submit', function(evt){
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
        console.log("НА ОТПРАВКУ");
        console.log(data);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: action,
            type: 'POST',
            data: {_token: CSRF_TOKEN, 'cat_id': cat_id, 'sub_id': sub_id, 'data': JSON.stringify(data)},
            success: function(data){
                if(data.success){
                    console.log(data);
                    $('.catalog-grid').empty();
                    var rez = data.result;
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
                        //   $('.catalog-goods-container').after('.catalog-header').append(card);
                        $('.catalog-grid').append(card);
                    });


                    // rez.forEach(function(value, i, rez){
                    //     $('.products-list').append("<p>" + value.VENDOR_CODE + "</p>");
                    // });

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

    });
});
