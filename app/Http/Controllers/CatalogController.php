<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CatalogController extends Controller
{
    public function catalog() {

        return view('catalog');
    }
}
