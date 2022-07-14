<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use DB;

class TabletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=DB::table('products')->where('type','tablet')->get();

        return view("tablet",compact('products'));
     
    }
}
