<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

function get_random_new(){
    $data = DB::table('PRODUCT')
                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                ->where('PRODUCT.IsNew', 1)
                ->inRandomOrder()
                ->take(4)
                ->get();

    return $data;
}

function get_random_leader(){
    $data = DB::table('PRODUCT')
                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                ->where('PRODUCT.IsLeader', 1)
                ->inRandomOrder()
                ->take(4)
                ->get();

    return $data;
}

function get_random_recomended(){
    $data = DB::table('PRODUCT')
                ->join('SUBCATEGORY', 'PRODUCT.ID_SUBCATEGORY', '=', 'SUBCATEGORY.ID_SUBCATEGORY')
                ->join('BREND','PRODUCT.ID_BREND', '=', 'BREND.ID_BREND')
                ->join('MODEL', 'PRODUCT.ID_MODEL', '=', 'MODEL.ID_MODEL')
                ->join('PICTURE', 'PRODUCT.ID_PICTURE', '=', 'PICTURE.ID_PICTURE')
                ->select('PRODUCT.*', 'SUBCATEGORY.Type as type', 'BREND.Name as brand', 'PICTURE.Name as pic', 'MODEL.Name as model')
                ->where('PRODUCT.IsRecomend', 1)
                ->inRandomOrder()
                ->take(4)
                ->get();

    return $data;
}

class IndexController extends Controller
{

    public function home() {

        $new_products = get_random_new();
        $leader_procucts = get_random_leader();
        $recomended_procucts = get_random_recomended();

        return view('home', [
                                'new_products' => $new_products,
                                'leader_products' => $leader_procucts,
                                'recomended_products' => $recomended_procucts,
                            ]);
    }

    public function about() {

        return view('about');
    }

    public function catalog() {

        return view('catalog');
    }

    public function news() {

        return view('news');
    }

    public function delivery() {

        return view('delivery');
    }

    public function contacts() {

        return view('contacts');
    }

    public function account() {

        return view('account');
    }

    public function checkout() {

        return view('checkout');
    }

    public function cart() {

        return view('cart');
    }
}
