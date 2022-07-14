<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use DB;

class SmartWatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        /*$types=DB::table('products')->where('type','telefon')->get();

        foreach ($types as $type) {
            echo $type->brand_name;
        }*/

        $products=DB::table('products')->where('type','Akilli_Saat')->get();

        return view("smartwatch",compact('products'));
     
    }
}
