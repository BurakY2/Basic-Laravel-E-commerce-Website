<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\models\Product;

class RomanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=DB::table('products')->where('type','roman')->get();

        return view("phone",compact('products'));
     
    }
}
