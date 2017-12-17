<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CatalogController extends Controller
{
    public function catalog() {

        /*
        * Значения которые будем доставать из реквеста
        */
        $my_category = '1';
        $my_subcategory = [];
        $all_subcategory_name = '';



        /*
        *   Считывает все подкатегории в базе данных, и считает
        *   кол-во товаров в этой подкатегории
        *   Возвращает ответ вида: [имя_подкатегории => число_товаров_в_подкатегории]
        */
        function get_all_sub(){
            $all_sub;
            $arr_sub_count;

            $all_sub = DB::table('SUBCATEGORY')
                            ->select('SUBCATEGORY.Name as name', 'SUBCATEGORY.ID_SUBCATEGORY as id')
                            ->get();
            foreach ($all_sub as $value) {
                $arr_sub_count[$value->name] = DB::table('PRODUCT')
                ->where('ID_SUBCATEGORY', '=', $value->id)
                ->count();
            }

            return $arr_sub_count;
        }

        /*
        * Получение списка брендов для всех категорий
        */
        function get_all_brands(){
            $brands;

            $brands = DB::table('BREND')
                            ->select('BREND.Name as name')
                            ->get();

            return $brands;
        }

        /*
        * Получает список всех продуктов по ID_CATEGORY
        */
        function get_category_products($id_category){
            $products_in_catogory;
            $arr_id_subcat = [];
            $data;

            $data = DB::table('SUBCATEGORY')
                        ->where('ID_CATEGORY', '=', $id_category)
                        ->get();

            foreach ($data as $value) {
                array_push($arr_id_subcat, $value->ID_SUBCATEGORY);
            }

            $products_in_catogory = DB::table('PRODUCT')
                                        ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                                        ->join('BREND', 'PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                                        ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                                        ->select('PRODUCT.*', 'SUBCATEGORY.Name as subcategory_name', 'BREND.Name as brand_name', 'PICTURE.Name as pic')
                                        ->whereIn('PRODUCT.ID_SUBCATEGORY', $arr_id_subcat)
                                        ->get();

            return $products_in_catogory;
        }


        $my_subcategory = [1];
        //выборка всех продуктов принадлежащих подкатегории
        $data = DB::table('PRODUCT')
                    ->where('ID_SUBCATEGORY', '=', $my_subcategory)
                    ->get();

        json_encode($data);
        //dd($data);

        $arr_sub_count = get_all_sub();
        $all_brands = get_all_brands();
        $category_products = get_category_products('1');


        return view('catalog', ['all_subcategory' => $arr_sub_count,
                                'all_brands' => $all_brands,
                                'products' =>$category_products,
                               ]);
    }
}
