<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Auth;

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
        if (Auth::check()) { //если аутентификация пройдена
            $user = Auth::user();
            $Name = $user->name;
            $Telephone = $user->Telephone;
            $Email = $user->email;
            $Adress = $user->Adress;
            return view('checkout', ['Name' => $Name, 'Telephone' => $Telephone, 'Email' => $Email, 'Adress' => $Adress]);
        } 
        else {
            return view('checkout', ['Name' => "", 'Telephone' => "", 'Email' => "", 'Adress' => ""]);
        }
        
    }

    public function cart() {
        return view('cart');
    }

    public function GetProductsCart(Request $request) {
        $Response = [];
        $Codes = $request->VendoreCodeArray;
        $Counts = $request->CountArray;
        for ($i = 0; $i < sizeof($Codes); $i++) { 
            $Product = DB::table('PRODUCT')->where('VENDOR_CODE', $Codes[$i])->first();
            $BrendName = DB::table('BREND')->where('ID_BREND', $Product->ID_BREND)->first()->Name;
            $ModelName = DB::table('MODEL')->where('ID_MODEL', $Product->ID_MODEL)->first()->Name;
            $PictureName = DB::table('PICTURE')->where('ID_PICTURE', $Product->ID_PICTURE)->first()->Name;
            
            $OneProduct = [
                'VendoreCode' => $Product->VENDOR_CODE,
                'BrendName' => $BrendName,
                'ModelName' => $ModelName,
                'Picture' => $PictureName,
                'Price' => $Product->Price,
                'Count' => $Counts[$i],
            ];
            array_push($Response, $OneProduct);
        }
        return json_encode($Response);
    }

    public function NewOrder(Request $request) {

        $AllVendors = $request->VendoreCodeArray;
        $AllCounts = $request->CountArray;
        $Product;
        for ($i = 0; $i < sizeof($AllVendors); $i++) { 
            $Product = DB::table('PRODUCT')->where('VENDOR_CODE', $AllVendors[$i])->first();
            
            if ($Product->Count < $AllCounts[$i]) { //если кол-во меньше кол-ва на складе
                $response = array(
                  'status' => 'success',
                  'msg' => $request->message,
                  'orderStatus' => "Товара артикул#" . $Product->VENDOR_CODE  . " на складе всего " . $Product->Count . " штук" . " Выберите другое кол-во!",
                );
                return response()->json($response);
            }
        }

        for ($i = 0; $i < sizeof($AllVendors); $i++) { 
            DB::table('PRODUCT')
                       ->where('VENDOR_CODE', $AllVendors[$i])
                       ->update(['Count' => ($Product->Count - $AllCounts[$i])]);
        }

        DB::table('ORDER')->insert(
        [
            // 'email' => $request->Email,
            'email' => "admin@mail.ru",
            'ID_STATUSORDER' => 4,
            'Telephone' => $request->Telephone,
            'Name' => $request->Name,
            'Adress' => $request->Adress,
            'ID_PaymentMethod' => $request->ID_Payment,
            'ID_DeliveryMethod' => $request->ID_Delivery,
            'Data' => $request->Date
        ]);

        $Order = DB::table('ORDER')->get();
        $ID_Order = $Order[sizeof($Order) - 1]->ID_ORDER;

        for ($i = 0; $i < sizeof($AllVendors); $i++) { 
            DB::table('ORER_PRODUCT')->insert(
            [
                'ID_ORDER' => $ID_Order,
                'VENDOR_CODE' => $AllVendors[$i],
                'Count' => $AllCounts[$i]
            ]);
        }

        //вернуть ответ на запрос в JSON формате(Успешный ответ)
        $response = array(
          'status' => 'success',
          'msg' => $request->message,
          'orderStatus' => 'Заказ успешно оформлен!',
        );
        return response()->json($response);
    }
}
