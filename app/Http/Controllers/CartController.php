<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use App\models\Cart;
use Illuminate\Support\Facades\Auth;
use DB;
//use Cart;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_quantitys=Product::all();

        foreach($product_quantitys as $product_quantity){
            $a=Cart::where(["product_id"=>  $product_quantity->id, "user_id" => Auth::id()])->value('quantity');
            $c=Cart::where(["product_id"=>  $product_quantity->id, "user_id" => Auth::id()])->value('product_id');
            $b=Product::where(["id"=>  $c])->value('quantity');

            if($a>$b){
                $a=Cart::where(["product_id"=>  $product_quantity->id, "user_id" => Auth::id()])->update(['quantity' => $b]);;
            }
        }
       
        $Carts=Cart::where("user_id",Auth::id())->join('products',"products.id", "=","carts.product_id" )
        ->get(['products.id',
        'products.name',
        'products.brand_name',
        'products.description',
        'products.image_name',
        'products.sale_price',
        'carts.quantity as product_quantity',
        'products.quantity',
        'carts.user_id',
        ]);
        
       
        return view("cart",compact('Carts'));
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
        /*
        $duplicates = Cart::search(function ($cartItem,$rowId) use ($request){
            
            return $cartItem->id === $request->id;
            

        });
        if($duplicates->isNotEmpty()){
            
            
            //return redirect() -> route("cart.index")->with('success_message','itemlerin zaten cartta');
        }
        Cart::add($request->id,$request->name,$request->quantity,$request->price)
            ->associate('App\models\Product');

        return \redirect()->route('cart.index')->with("success_message",'item was your add your cart');  
        */


        


            //$products=Product::where('id',$request->id)->get();

            $products_quantity=Product::where('id',$request->id)->value("quantity");
            $cartProducts_quantity=Cart::where(['product_id'=>$request->id,
            "user_id"=>  $request->user_id,
            ])->value("quantity");

            $carts_id=Cart::where('user_id',$request->user_id)->value("user_id");
            $product_id=Cart::where('user_id',$request->user_id)->value("product_id");
                            
            $increment = $request->quantity;
            $fazlalik =  ($cartProducts_quantity +  $request->quantity);     
            
            
            if($carts_id == $request->user_id  && $product_id == $request->id ){
               
                if($products_quantity >= $fazlalik){
                    Cart::where(['product_id'=>$request->id,
                    "user_id"=>  $request->user_id,
                    ])->increment('quantity',$increment);
                    
                }
                else
                {
                    
                    return \redirect()->route('cart.index')->with("success_message",'item quantity fazla');
                }
                
            }
            else{
                
                $productcart = Cart::create([
                    'product_id' => $request->id,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'user_id' => $request->user_id,
                ]);
                
            }
           
       
            return \redirect()->route('cart.index')->with("success_message",'item was your add your cart');
       

    }

    public function empty(){
        Cart::destroy();
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $as=Cart::where("user_id",$id)->get();
        foreach($as as $a){
            DB::table('products')->where('id', $a->product_id)->decrement('quantity',$a->quantity);
            Cart::where(["product_id"=>  $a->product_id, "user_id" => $a->user_id])->delete();
        }
        return back()->with("success_message","Satış Tamamlandı");
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

        $products_quantity=Product::where(['id'=>$id,
        ])->value("quantity");
        $cartProducts_quantity=Cart::where(['product_id'=>$id,
        "user_id"=>  $request->use_id,
        ])->value("quantity");

        $increment = $request->quantity;
        
        echo $request->quantity;
        echo $request->use_id;
        
        if($products_quantity >= $increment){
            $a=Cart::where(['product_id'=>$id,
            "user_id"=>  $request->use_id,
            ])->update(['quantity' => $increment]);       
            echo $a;
            
            if($products_quantity == $increment){
                session()->flash('success_message','Stokdaki ürünlerin hepsi cartta daha fazla Artıramazsınız');
                return response()->json(['success'=>true]);
            }
            else{
                session()->flash('success_message','miktar artirldi');
                return response()->json(['success'=>true]);

            }  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        Cart::where(['product_id'=>$id,
                    "user_id"=>  $request->user_id,
                    ])->delete();
        

        return back()->with("success_message","item silindi");
    }

    
}
