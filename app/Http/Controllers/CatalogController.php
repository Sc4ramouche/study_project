<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

/*
* Получение фильтров по категории
* принимает значение @string id_category
* возвращает массив фильтров
*/
function get_filters_by_category($id_cat){
    $arr_id_subcat = [];
    $material = [];
    $filters = [];

    $data = DB::table('SUBCATEGORY')
                ->where('ID_CATEGORY', '=', $id_cat)
                ->get();

    foreach ($data as $value) {
        array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
    }

    //Подкатегории и кол-во товаров в подкатегории в $arr_subcategory_count
    $all_sub = DB::table('SUBCATEGORY')
                    ->select('SUBCATEGORY.Name as name', 'SUBCATEGORY.ID_SUBCATEGORY as id')
                    ->where('ID_CATEGORY', '=', $id_cat)
                    ->get();
    $filters['subcategory'] = [];
    foreach ($all_sub as $value) {

        $count = DB::table('PRODUCT')
                    ->where('ID_SUBCATEGORY', '=', $value->id)
                    ->whereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();


        array_push($filters['subcategory'], [
                                                'sub_id' => $value->id,
                                                'sub_name' => $value->name,
                                                'sub_count' => $count,
                                            ]);

    }

    //Страны и кол-во товаров страны в $arr_country_count
    $filters['country'] = [];
    $country = DB::table('COUNTRY')
                    ->select('COUNTRY.Name as name', 'COUNTRY.ID_COUNTRY as id')
                    ->get();
    foreach ($country as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_COUNTRY', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['country'],[
                                        'country_id' => $value->id,
                                        'country_name' => $value->name,
                                        'country_count' => $count
                                      ]);
    }

    //Бренды и кол-во товаров этого бренда в $arr_brand_count
    $filters['brand'] = [];
    $brand = DB::table('BREND')
                    ->select('BREND.Name as name', 'BREND.ID_BREND as id')
                    ->get();
    foreach ($brand as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_BREND', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['brand'],[
                                        'brand_id' => $value->id,
                                        'brand_name' => $value->name,
                                        'brand_count' => $count
                                      ]);
    }

    //Модели и кол-во товаров этой модели в $arr_model_count
    $filters['model'] = [];
    $model = DB::table('MODEL')
                    ->select('MODEL.Name as name', 'MODEL.ID_MODEL as id')
                    ->get();
    foreach ($model as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MODEL', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['model'],[
                                        'model_id' => $value->id,
                                        'model_name' => $value->name,
                                        'model_count' => $count
                                      ]);

    }

    //Материалы и кол-во товаров из этого материала в $arr_model_count
    $filters['material'] = [];
    $material = DB::table('MATERIAL')
                    ->select('MATERIAL.Name as name', 'MATERIAL.ID_MATERIAL as id')
                    ->get();
    foreach ($material as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MATERIAL', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['material'],[
                                        'material_id' => $value->id,
                                        'material_name' => $value->name,
                                        'material_count' => $count
                                      ]);
    }

    //Фильтр стоимости min max
    $price_min = DB::table('PRODUCT')
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->min('Price');
    $price_max = DB::table('PRODUCT')
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->max('Price');

    $filters['price_min'] = $price_min;
    $filters['price_max'] = $price_max;

    return $filters;

}

/*
* Получение фильтров по подкатегории
* принимает значение @string id_category для списка подкатегорий
* второй аргумент @string id_subcategory
* возвращает массив фильтров
*/
function get_filters_by_subcategory($id_cat, $id_sub){
    $arr_id_subcat = [];
    $material = [];
    $filters = [];


    $data = DB::table('SUBCATEGORY')
                ->where('ID_CATEGORY', '=', $id_cat)
                ->get();

    foreach ($data as $value) {
        array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
    }

    //Подкатегории и кол-во товаров в подкатегории в $arr_subcategory_count
    $all_sub = DB::table('SUBCATEGORY')
                    ->select('SUBCATEGORY.Name as name', 'SUBCATEGORY.ID_SUBCATEGORY as id')
                    ->where('ID_CATEGORY', '=', $id_cat)
                    ->get();

    $filters['subcategory'] = [];
    foreach ($all_sub as $value) {

        $count = DB::table('PRODUCT')
                    ->where('ID_SUBCATEGORY', '=', $value->id)
                    ->whereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();


        array_push($filters['subcategory'], [
                                                'sub_id' => $value->id,
                                                'sub_name' => $value->name,
                                                'sub_count' => $count,
                                            ]);

    }

    //Страны и кол-во товаров страны в $arr_country_count
    $filters['country'] = [];
    $country = DB::table('COUNTRY')
                    ->select('COUNTRY.Name as name', 'COUNTRY.ID_COUNTRY as id')
                    ->get();
    foreach ($country as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_COUNTRY', '=', $value->id)
                    ->where('ID_SUBCATEGORY', '=', $id_sub)
                    ->count();
        array_push($filters['country'],[
                                        'country_id' => $value->id,
                                        'country_name' => $value->name,
                                        'country_count' => $count
                                      ]);
    }

    //Бренды и кол-во товаров этого бренда в $arr_brand_count
    $filters['brand'] = [];
    $brand = DB::table('BREND')
                    ->select('BREND.Name as name', 'BREND.ID_BREND as id')
                    ->get();
    foreach ($brand as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_BREND', '=', $value->id)
                    ->where('ID_SUBCATEGORY', $id_sub)
                    ->count();
        array_push($filters['brand'],[
                                        'brand_id' => $value->id,
                                        'brand_name' => $value->name,
                                        'brand_count' => $count
                                      ]);
    }

    //Модели и кол-во товаров этой модели в $arr_model_count
    $filters['model'] = [];
    $model = DB::table('MODEL')
                    ->select('MODEL.Name as name', 'MODEL.ID_MODEL as id')
                    ->get();
    foreach ($model as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MODEL', '=', $value->id)
                    ->where('ID_SUBCATEGORY', $id_sub)
                    ->count();
        array_push($filters['model'],[
                                        'model_id' => $value->id,
                                        'model_name' => $value->name,
                                        'model_count' => $count
                                      ]);

    }

    //Материалы и кол-во товаров из этого материала в $arr_model_count
    $filters['material'] = [];
    $material = DB::table('MATERIAL')
                    ->select('MATERIAL.Name as name', 'MATERIAL.ID_MATERIAL as id')
                    ->get();
    foreach ($material as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MATERIAL', '=', $value->id)
                    ->where('ID_SUBCATEGORY', $id_sub)
                    ->count();
        array_push($filters['material'],[
                                        'material_id' => $value->id,
                                        'material_name' => $value->name,
                                        'material_count' => $count
                                      ]);
    }

    //Фильтр стоимости min max
    $price_min = DB::table('PRODUCT')
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->min('Price');
    $price_max = DB::table('PRODUCT')
                    ->where('ID_SUBCATEGORY', $id_sub)
                    ->max('Price');

    $filters['price_min'] = $price_min;
    $filters['price_max'] = $price_max;

    return $filters;

}


function get_all_filters_value(){
    $arr_id_subcat = [];
    $material = [];
    $filters = [];

    $data = DB::table('SUBCATEGORY')
                ->get();

    foreach ($data as $value) {
        array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
    }

    //Подкатегории и кол-во товаров в подкатегории в $arr_subcategory_count
    $all_sub = DB::table('SUBCATEGORY')
                    ->select('SUBCATEGORY.Name as name', 'SUBCATEGORY.ID_SUBCATEGORY as id')
                    ->get();
    $filters['subcategory'] = [];
    foreach ($all_sub as $value) {

        $count = DB::table('PRODUCT')
                    ->where('ID_SUBCATEGORY', '=', $value->id)
                    ->whereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();


        array_push($filters['subcategory'], [
                                                'sub_id' => $value->id,
                                                'sub_name' => $value->name,
                                                'sub_count' => $count,
                                            ]);

    }

    //Страны и кол-во товаров страны в $arr_country_count
    $filters['country'] = [];
    $country = DB::table('COUNTRY')
                    ->select('COUNTRY.Name as name', 'COUNTRY.ID_COUNTRY as id')
                    ->get();
    foreach ($country as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_COUNTRY', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['country'],[
                                        'country_id' => $value->id,
                                        'country_name' => $value->name,
                                        'country_count' => $count
                                      ]);
    }

    //Бренды и кол-во товаров этого бренда в $arr_brand_count
    $filters['brand'] = [];
    $brand = DB::table('BREND')
                    ->select('BREND.Name as name', 'BREND.ID_BREND as id')
                    ->get();
    foreach ($brand as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_BREND', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['brand'],[
                                        'brand_id' => $value->id,
                                        'brand_name' => $value->name,
                                        'brand_count' => $count
                                      ]);
    }

    //Модели и кол-во товаров этой модели в $arr_model_count
    $filters['model'] = [];
    $model = DB::table('MODEL')
                    ->select('MODEL.Name as name', 'MODEL.ID_MODEL as id')
                    ->get();
    foreach ($model as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MODEL', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['model'],[
                                        'model_id' => $value->id,
                                        'model_name' => $value->name,
                                        'model_count' => $count
                                      ]);

    }

    //Материалы и кол-во товаров из этого материала в $arr_model_count
    $filters['material'] = [];
    $material = DB::table('MATERIAL')
                    ->select('MATERIAL.Name as name', 'MATERIAL.ID_MATERIAL as id')
                    ->get();
    foreach ($material as $value) {
        $count = DB::table('PRODUCT')
                    ->where('ID_MATERIAL', '=', $value->id)
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->count();
        array_push($filters['material'],[
                                        'material_id' => $value->id,
                                        'material_name' => $value->name,
                                        'material_count' => $count
                                      ]);
    }

    //Фильтр стоимости min max
    $price_min = DB::table('PRODUCT')
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->min('Price');
    $price_max = DB::table('PRODUCT')
                    ->whereIn('ID_SUBCATEGORY', $arr_id_subcat)
                    ->max('Price');

    $filters['price_min'] = $price_min;
    $filters['price_max'] = $price_max;

    return $filters;
}
// function get_all_filters_value(){
//
//     $all_filters_value = [];
//     $id_sub = [];
//
//     $all_sub = DB::table('SUBCATEGORY')
//                     ->select('SUBCATEGORY.Name as name', 'SUBCATEGORY.ID_SUBCATEGORY as id')
//                     ->get();
//     foreach ($all_sub as $value) {
//         $arr_sub_count[$value->name] = DB::table('PRODUCT')
//         ->where('ID_SUBCATEGORY', '=', $value->id)
//         ->count();
//         array_push($id_sub, $value->id);
//     }
//     $all_filters_value['subcategory'] = $arr_sub_count;
//     $all_filters_value['id_subcategory'] = $id_sub;
//
//     $all_country = DB::table('COUNTRY')
//                     ->select('COUNTRY.Name as name', 'COUNTRY.ID_COUNTRY as id')
//                     ->get();
//     foreach ($all_country as $value) {
//         $arr_country_count[$value->name] = DB::table('PRODUCT')
//         ->where('ID_SUBCATEGORY', '=', $value->id)
//         ->count();
//     }
//     $all_filters_value['country'] = $arr_country_count;
//
//     $all_brand = DB::table('BREND')
//                     ->select('BREND.Name as name', 'BREND.ID_BREND as id')
//                     ->get();
//     foreach ($all_brand as $value) {
//         $arr_brand_count[$value->name] = DB::table('PRODUCT')
//         ->where('ID_SUBCATEGORY', '=', $value->id)
//         ->count();
//     }
//     $all_filters_value['brand'] = $arr_brand_count;
//
//     $all_model = DB::table('MODEL')
//                     ->select('MODEL.Name as name', 'MODEL.ID_MODEL as id')
//                     ->get();
//     foreach ($all_model as $value) {
//         $arr_model_count[$value->name] = DB::table('PRODUCT')
//         ->where('ID_SUBCATEGORY', '=', $value->id)
//         ->count();
//     }
//     $all_filters_value['model'] = $arr_model_count;
//
//     $all_material = DB::table('MATERIAL')
//                     ->select('MATERIAL.Name as name', 'MATERIAL.ID_MATERIAL as id')
//                     ->get();
//     foreach ($all_material as $value) {
//         $arr_matrial_count[$value->name] = DB::table('PRODUCT')
//         ->where('ID_SUBCATEGORY', '=', $value->id)
//         ->count();
//     }
//     $all_filters_value['material'] = $arr_matrial_count;
//
//     $price_min = DB::table('PRODUCT')->min('Price');
//     $price_max = DB::table('PRODUCT')->max('Price');
//     $all_filters_value['price_min'] = $price_min;
//     $all_filters_value['price_max'] = $price_max;
//
//     return $all_filters_value;
// }

    /*
    * Получает список всех продуктов по ID_CATEGORY
    * (Пользователь перешел по ссылке категории)
    */
    function get_category_products($id_category, $take_count){
        $products_in_catogory;
        $arr_id_subcat = [];
        $data;

        $data = DB::table('SUBCATEGORY')
                    ->where('ID_CATEGORY', '=', $id_category)
                    ->get();

        foreach ($data as $value) {
            array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
        }

        $products_in_category = DB::table('PRODUCT')
                                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                    ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                    ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                                    ->WhereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                                    ->skip(0)
                                    ->take($take_count)
                                    ->get();

        // dd($products_in_category);
        return $products_in_category;
    }

    /*
    * Получает список всех продуктов по ID_SUBCATEGORY
    * (Пользователь нажал на сабкатегорию в каталоге)
    */
    function get_subcategory_products($id_subcategory, $take_count){
        $data = DB::table('PRODUCT')
                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                    ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                    ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                    ->where('PRODUCT.ID_SUBCATEGORY', $id_subcategory)
                    ->skip(0)
                    ->take($take_count)
                    ->get();
        return $data;
    }

        function get_all_products($take_count){
        $data = DB::table('PRODUCT')
                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                    ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                    ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                    ->skip(0)
                    ->take($take_count)
                    ->get();
        return $data;
    }

    function filter_all($f, $sort, $skip_count, $take_count){
        $arr = $f;

        $products_in_category = DB::table('PRODUCT')
                                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                    ->join('COUNTRY', function($join) use ($arr){
                                        $join->on('PRODUCT.ID_COUNTRY', '=', 'COUNTRY.ID_COUNTRY')
                                             ->where(function($query) use ($arr){
                                                if((array_key_exists('country', $arr)) && (count($arr['country']) > 0))
                                                    $query->whereIn('COUNTRY.Name', $arr['country']);
                                             });
                                    })
                                    ->join('BREND', function($join) use ($arr){
                                        $join->on('PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                             ->where(function($query) use ($arr){
                                                if((array_key_exists('brand', $arr)) && (count($arr['brand']) > 0))
                                                    $query->whereIn('BREND.Name', $arr['brand']);
                                             });
                                    })
                                    ->join('MODEL', function($join) use ($arr){
                                        $join->on('PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                                             ->where(function($query) use($arr){
                                                 if((array_key_exists('model', $arr)) && (count($arr['model']) > 0))
                                                    $query->whereIn('MODEL.Name', $arr['model']);
                                             });
                                    })
                                    ->join('MATERIAL', function($join) use ($arr){
                                        $join->on('PRODUCT.ID_MATERIAL', '=', 'MATERIAL.ID_MATERIAL')
                                             ->where(function($query) use($arr){
                                                 if((array_key_exists('material', $arr)) && (count($arr['material']) > 0))
                                                    $query->whereIn('MATERIAL.Name', $arr['material']);
                                             });
                                    })
                                    ->where(function($query) use($arr){
                                        if($arr['price_min'] !== "" && $arr['price_max'] !== "")
                                            $query->whereBetween('Price',[$arr['price_min'], $arr['price_max']]);
                                    })
                                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                                    ->when($sort['name'], function($query) use($sort){
                                        return $query->orderBy($sort['name'], $sort['type']);
                                    })
                                    ->skip($skip_count)
                                    ->take($take_count)
                                    ->get();

        return $products_in_category;
    }

function filter_with_category($id_category, $f, $sort, $skip_count, $take_count){
    $products_in_category;
    $arr_id_subcat = [];

    $data = DB::table('SUBCATEGORY')
                ->where('ID_CATEGORY', '=', $id_category)
                ->get();

    foreach ($data as $value) {
        array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
    }

    $arr = $f;

    $products_in_category = DB::table('PRODUCT')
                                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                ->join('COUNTRY', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_COUNTRY', '=', 'COUNTRY.ID_COUNTRY')
                                         ->where(function($query) use ($arr){
                                            if((array_key_exists('country', $arr)) && (count($arr['country']) > 0))
                                                $query->whereIn('COUNTRY.Name', $arr['country']);

                                         });
                                })
                                ->join('BREND', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                         ->where(function($query) use ($arr){
                                            if((array_key_exists('brand', $arr)) && (count($arr['brand']) > 0))
                                                $query->whereIn('BREND.Name', $arr['brand']);

                                         });
                                })
                                ->join('MODEL', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                                         ->where(function($query) use($arr){
                                             if((array_key_exists('model', $arr)) && (count($arr['model']) > 0))
                                                $query->whereIn('MODEL.Name', $arr['model']);
                                         });
                                })
                                ->join('MATERIAL', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_MATERIAL', '=', 'MATERIAL.ID_MATERIAL')
                                         ->where(function($query) use($arr){
                                             if((array_key_exists('material', $arr)) && (count($arr['material']) > 0))
                                                $query->whereIn('MATERIAL.Name', $arr['material']);
                                         });
                                })
                                ->where(function($query) use($arr){
                                    if($arr['price_min'] !== "" && $arr['price_max'] !== "")
                                        $query->whereBetween('Price',[$arr['price_min'], $arr['price_max']]);
                                })
                                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                                ->whereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                                ->when($sort['name'], function($query) use($sort){
                                    return $query->orderBy($sort['name'], $sort['type']);
                                })
                                ->skip($skip_count)
                                ->take($take_count)
                                ->get();
    return $products_in_category;
}

function filter_with_subcategory($id_subcategory, $f, $sort, $skip_count, $take_count){
    $arr = $f;

    $products_in_category = DB::table('PRODUCT')
                                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                ->join('COUNTRY', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_COUNTRY', '=', 'COUNTRY.ID_COUNTRY')
                                         ->where(function($query) use ($arr){
                                            if((array_key_exists('country', $arr)) && (count($arr['country']) > 0))
                                                $query->whereIn('COUNTRY.Name', $arr['country']);
                                         });
                                })
                                ->join('BREND', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                         ->where(function($query) use ($arr){
                                            if((array_key_exists('brand', $arr)) && (count($arr['brand']) > 0))
                                                $query->whereIn('BREND.Name', $arr['brand']);
                                         });
                                })
                                ->join('MODEL', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                                         ->where(function($query) use($arr){
                                             if((array_key_exists('model', $arr)) && (count($arr['model']) > 0))
                                                $query->whereIn('MODEL.Name', $arr['model']);
                                         });
                                })
                                ->join('MATERIAL', function($join) use ($arr){
                                    $join->on('PRODUCT.ID_MATERIAL', '=', 'MATERIAL.ID_MATERIAL')
                                         ->where(function($query) use($arr){
                                             if((array_key_exists('material', $arr)) && (count($arr['material']) > 0))
                                                $query->whereIn('MATERIAL.Name', $arr['material']);
                                         });
                                })
                                ->where(function($query) use($arr){
                                    if($arr['price_min'] !== "" && $arr['price_max'] !== "")
                                        $query->whereBetween('Price',[$arr['price_min'], $arr['price_max']]);
                                })
                                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                                ->where('PRODUCT.ID_SUBCATEGORY', '=', $id_subcategory)
                                ->when($sort['name'], function($query) use($sort){
                                    return $query->orderBy($sort['name'], $sort['type']);
                                })
                                ->skip($skip_count)
                                ->take($take_count)
                                ->get();
    return $products_in_category;
}

//Получение продукта по артиклу для карточки товара
function get_product_by_id($id) {
    $data = DB::table('PRODUCT')
                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                ->join('MATERIAL', 'PRODUCT.ID_MATERIAL', '=', 'MATERIAL.ID_MATERIAL')
                ->join('COUNTRY', 'PRODUCT.ID_COUNTRY', '=', 'COUNTRY.ID_COUNTRY')
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'SUBCATEGORY.Name as subname', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model', 'MATERIAL.Name as material', 'COUNTRY.Name as country')
                ->where('PRODUCT.VENDOR_CODE', $id)
                ->get();
    return $data;

}

function get_sub_picture($id) {
    $data = DB::table('SECONDPICTURE')
                ->select('SECONDPICTURE.Name as sec_pic')
                ->where('SECONDPICTURE.VENDOR_CODE', $id)
                ->get();
    return $data;
}

function get_characteristic($id) {
    $data = DB::table('ALLCHARACTERISTICS')
                ->join('CHARACTERISTICSUBC', 'ALLCHARACTERISTICS.ID_CHARACTERISTICSUBC', '=', 'CHARACTERISTICSUBC.ID_CHARACTERISTICSUBC')
                ->join('VALUESUBC', 'ALLCHARACTERISTICS.ID_VALUESUBC', '=', 'VALUESUBC.ID_VALUESUBC')
                ->select('CHARACTERISTICSUBC.Name as name', 'VALUESUBC.Name as value')
                ->where('ALLCHARACTERISTICS.VENDOR_CODE',$id)
                ->get();

    return $data;
}

function get_related_products($sub_id) {
    $data = DB::table('PRODUCT')
                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                ->where('PRODUCT.ID_SUBCATEGORY', $sub_id)
                ->inRandomOrder()
                ->take(4)
                ->get();
    return $data;
}

class CatalogController extends Controller
{


    public function ajax_filter(Request $req){

        $cat_id = $req->cat_id;
        $sub_id = $req->sub_id;
        $sort = json_decode($req->sort, true);
        $skip_count = $req->skip_count;
        $take_count = $req->take_count;
        $page_number = $req->page_number;
        $data = json_decode($req->data, true);

        if($cat_id === '') {
            $result = filter_all($data, $sort, $skip_count, $take_count);
        }elseif($sub_id === ''){
            $result = filter_with_category($cat_id, $data, $sort, $skip_count, $take_count);
        } else {
            $result = filter_with_subcategory($sub_id, $data, $sort, $skip_count, $take_count);
        };


        $res = [
            'success' => 'true',
            'msg' => 'its work',
            'result' => $result,
        ];

        return response()->json($res);
    }

    public function catalog_category($category){

        //дефолтное число продуктов на странице
        $products_on_page = 12;
        //число продуктов
        $d = DB::table('SUBCATEGORY')
                    ->where('ID_CATEGORY', '=', $category)
                    ->get();
        $arr_id_subcat = [];
        foreach ($d as $value) {
            array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
        }

        $count = DB::table('PRODUCT')->WhereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)->count();
        //число страниц с округлением в большкую сторону
        $page_count = (int) ceil($count / $products_on_page);

        $id_category = $category;
        $filters = [];
        $filtr = [];

        $filters = get_filters_by_category($id_category, $filtr);
        $products = get_category_products($id_category, $products_on_page);
        return view('catalog', [
                                'category_id' => $id_category,
                                'subcategory_id' => '',
                                'filters' => $filters,
                                'products' => $products,
                                'page_count' => $page_count,
                                'products_count' => $count,

                               ]);
    }

    public function catalog_subcategory($category, $subcategory){

        //дефолтное число продуктов на странице
        $products_on_page = 12;
        //число продуктов
        $count = DB::table('PRODUCT')->where('PRODUCT.ID_SUBCATEGORY', $subcategory)->count();
        //число страниц с округлением в большкую сторону
        $page_count = (int) ceil($count / $products_on_page);

        $products = get_subcategory_products($subcategory, $products_on_page);
        $filters = get_filters_by_subcategory($category, $subcategory);

        return view('catalog', [
                                'category_id' => $category,
                                'subcategory_id' => $subcategory,
                                'filters' => $filters,
                                'products' => $products,
                                'page_count' => $page_count,
                                'products_count' => $count,
                               ]);
    }

    public function catalog(Request $req) {

        //дефолтное число продуктов на странице
        $products_on_page = 12;
        //число продуктов
        $count = DB::table('PRODUCT')->count();
        //число страниц с округлением в большкую сторону
        $page_count = (int) ceil($count / $products_on_page);

        //dd($page_count);

        $filters = get_all_filters_value();
        $products = get_all_products($products_on_page);
        return view('catalog', [
                                'products' => $products,
                                'filters' => $filters,
                                'category_id' => '',
                                'subcategory_id' => '',
                                'page_count' => $page_count,
                                'products_count' => $count,
                               ]);
    }

    public function productcard($vendor_code) {
        $id = $vendor_code;
        $product = get_product_by_id($id);
        $sub_picture = get_sub_picture($id);
        $sub_id = $product[0]->ID_SUBCATEGORY;
        $related_products = get_related_products($sub_id);
        $characteristic = get_characteristic($id);

        // dd($product, $sub_picture);

        return view('productcard', [
                                    'product' => $product,
                                    'sub_pic' => $sub_picture,
                                    'related_products' => $related_products,
                                    'characteristic' => $characteristic,
                                   ]);
    }

}
