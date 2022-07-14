@extends('layouts.app')
@section('content')

<style>
.clickable {
  margin-bottom: 15px;
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
  position: absolute;     
  z-index: 1;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    padding: 30px;
}
.product-card {
    flex: 1 20%;
    text-align: center;
    margin-bottom: 25px;
}
.product-card img {
    margin-bottom: 15px;
    height: 250px;
}
@media only screen and (min-width:768px) and (max-width:991px) {
   .product-card {
       flex: 1 50%;
   }
}
@media only screen  and (max-width:767px) {
   .product-card {
       flex: 100%;
    }
}
</style>   

<div class="product-container" >
    @if (isset($products))
        @foreach ( $products as $product  )
            <div class="product-card">
               
                <a href="{{route("product.show",$product->id)}}">
                    <img  src="{{$product->image_name}}" alt="Image">
                </a>
                
                <h3 class="product-title">{{ $product->name}}</h3>
                <span class="product-price">{{ number_format($product->sale_price,2)}} TL</span>
            </div>
        
        @endforeach
        
    @endif
</div>
@endsection