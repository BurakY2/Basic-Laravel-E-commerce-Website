<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use App\models\production_detailsails;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=Product::all();

        return view("mainpage",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product=Product::where('products.id',$id)->join('production_detailsails',"production_detailsails.product_id", "=","products.id" )
        ->get(['products.id',
        'products.name',
        'products.brand_name',
        'products.description',
        'products.image_name',
        'products.sale_price',
        'products.quantity',
        'production_detailsails.Depolama_Alani',
        'production_detailsails.Ekran_Boyutu',
        'production_detailsails.Ram',
        'production_detailsails.Yazar',
        'production_detailsails.Çevirmen',
        'production_detailsails.Sayfa_Sayisi',
        'production_detailsails.Baski_Sayisi',
        'production_detailsails.Dil',
        'production_detailsails.İlk_Baski_Yili',
        'products.type'
        ]);
        

        //$products=Product::where('id',$id)->firstOrfail();

        //return view("product",compact('products'));

        
        return view("product",compact('Product'));

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
