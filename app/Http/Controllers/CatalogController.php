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
    function get_category_products($id_category, $f){
        $products_in_catogory;
        $arr_id_subcat = [];
        $data;

        $data = DB::table('SUBCATEGORY')
                    ->where('ID_CATEGORY', '=', $id_category)
                    ->get();

        foreach ($data as $value) {
            array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
        }

        $f = [
            'brand' => [
                    'Rondell',
                ],
            'model' => [
                    'Anezka',
                    'Augusta',
            ]
        ];
        $products_in_category = DB::table('PRODUCT')
                                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                    ->join('BREND', function($join) use ($f){
                                        $join->on('PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                             ->where(function($query) use ($f){
                                                if(array_key_exists('brand',$f))
                                                    $query->whereIn('BREND.Name', $f['brand']);
                                             });
                                    })
                                    ->join('MODEL', function($join) use ($f){
                                        $join->on('PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                                             ->where(function($query) use($f){
                                                 if(array_key_exists('model', $f))
                                                    $query->whereIn('MODEL.Name', $f['model']);
                                             });
                                    })
                                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                                    ->where('PRODUCT.ID_BREND', '1')
                                    ->orWhereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                                    ->get();

        // dd($products_in_category);
        return $products_in_category;
    }

    /*
    * Получает список всех продуктов по ID_SUBCATEGORY
    * (Пользователь нажал на сабкатегорию в каталоге)
    */
    function get_subcategory_products($id_subcategory){
        $data = DB::table('PRODUCT')
                    ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                    ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                    ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                    ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                    ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                    ->where('PRODUCT.ID_SUBCATEGORY', $id_subcategory)
                    ->get();
        return $data;
    }

function filter_with_category($id_category, $f){
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
                                ->get();
    return $products_in_category;
}

function filter_with_subcategory($id_subcategory, $f){
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
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                ->where('PRODUCT.VENDOR_CODE', $id)
                ->get();
    return $data;

}

class CatalogController extends Controller
{

    public function test(){
        get_category_products(1,1);
        return '1';
    }

    public function ajax_filter(Request $req){

        $cat_id = $req->cat_id;
        $sub_id = $req->sub_id;
        if($sub_id === ''){
            $result = filter_with_category($cat_id, json_decode($req->data, true));
        } else {
            $result = filter_with_subcategory($sub_id, json_decode($req->data, true));
        }


        $res = [
            'success' => 'true',
            'msg' => 'its work',
            'result' => $result,
        ];

        return response()->json($res);
    }

    public function catalog_category($category){
        $id_category = $category;
        $filters = [];
        $filtr = [];

        $filters = get_filters_by_category($id_category, $filtr);
        $category_products = get_category_products($id_category, $filtr);

        return view('catalog', [
                                'category_id' => $id_category,
                                'subcategory_id' => '',
                                'filters' => $filters,
                                'products' => $category_products,

                               ]);
    }

    public function catalog_subcategory($category, $subcategory){
        $products = get_subcategory_products($subcategory);
        $filters = get_filters_by_subcategory($category, $subcategory);

        return view('catalog', [
                                'category_id' => $category,
                                'subcategory_id' => $subcategory,
                                'filters' => $filters,
                                'products' => $products,
                               ]);
    }

    public function catalog() {
        $filters = get_all_filters_value();
        return view('catalog', [
                                'products' => [],
                                'filters' => $filters,
                                'category_id' => '',
                                'subcategory_id' => '',

                               ]);
    }

    public function productcard($vendor_code) {
        $id = $vendor_code;
        $product = get_product_by_id($id);
        // dd($product);

        return view('productcard', [
                                    'product' => $product,
                                   ]);
    }

}
