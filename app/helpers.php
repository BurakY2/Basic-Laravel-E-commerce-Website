

<?php
  
  use App\models\Product;
  use App\models\Cart;


    
    
    function ShowCartCount($id){
        $noOfVisit = Cart::where('user_id',$id)->count();

        return $noOfVisit ;
    }

    function CartTotal($id){
        $SumPrice = Cart::where('user_id',$id)->sum('price');
        $amount = Cart::select(DB::raw('sum(quantity * price) as total'))->where('user_id',$id)->value("total");
        return number_format($amount, 2);
    }


    function Checkout(){

    }
