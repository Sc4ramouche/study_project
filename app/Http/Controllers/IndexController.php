<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function home() {

        return view('home');
    }

    public function about() {

        return view('about');
    }

    public function catalog() {

        return view('catalog');
    }

    public function card_product() {

        return view('card_product');
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
}
