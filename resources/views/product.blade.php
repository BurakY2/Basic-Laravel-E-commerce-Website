@extends('layouts.app')

@section('content')

<style>
ul > li{margin-right:25px;font-weight:lighter;cursor:pointer}
li.active{border-bottom:3px solid silver;}

.item-photo{display:flex;justify-content:center;align-items:center;border-right:1px solid #f6f6f6;}
.menu-items{list-style-type:none;font-size:11px;display:inline-flex;margin-bottom:0;margin-top:20px}
.btn-success{width:100%;border-radius:0;}
.section{width:100%;margin-left:-15px;padding:2px;padding-left:15px;padding-right:15px;background:#f8f9f9}
.title-price{margin-top:30px;margin-bottom:0;color:black}
.title-attr{margin-top:0;margin-bottom:0;color:black;}
.btn-minus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-right:0;}
.btn-plus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-left:0;}
div.section > div {width:100%;display:inline-flex;}
div.section > div > input {margin:0;padding-left:5px;font-size:10px;padding-right:5px;max-width:18%;text-align:center;}
.attr,.attr2{cursor:pointer;margin-right:5px;height:20px;font-size:10px;padding:2px;border:1px solid gray;border-radius:2px;}
.attr.active,.attr2.active{ border:1px solid orange;}

@media (max-width: 426px) {
    .container {margin-top:0px !important;}
    .container > .row{padding:0 !important;}
    .container > .row > .col-xs-12.col-sm-5{
        padding-right:0 ;    
    }
    .container > .row > .col-xs-12.col-sm-9 > div > p{
        padding-left:0 !important;
        padding-right:0 !important;
    }
    .container > .row > .col-xs-12.col-sm-9 > div > ul{
        padding-left:10px !important;
        
    }            
    .section{width:104%;}
    .menu-items{padding-left:0;}
}
</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    @foreach ( $Product as $products )
    <body>
        <div class="container">
        	<div class="row">
               <div class="col-xs-4 item-photo">
                    <img style="max-width:100%;" src="{{$products->image_name}}" />
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    
                    <h3>{{$products->name}}</h3>
                    @if($products->type == 'edebiyat' ||$products->type == 'roman' || $products->type == 'bilim')
                    <h5 style="color:#010305">Yayınevi: <a>{{$products->brand_name}}</a><small style="color:#337ab7"></small></h5>
                    @else
                    <h5 style="color:#010305">Marka: <a>{{$products->brand_name}}</a><small style="color:#337ab7"></small></h5>
                    @endif    
                    

                    <h3 style="margin-top:0px;">{{ number_format($products->sale_price,2) }} TL </h3>

                    {{-- <div class="section" style="padding-bottom:20px;">
                        <h6 class="title-attr"><small>{{  $product->quantity }}</small></h6>                    
                        <div>
                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                            <input value="1" />
                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </div> --}}
                                  
        
                    <!-- Botones de compra -->
                    <div class="section" style="padding-bottom:20px;">
                        @if (Auth::check())
                        

                        <form action="{{ route('cart.store') }}" method = "POST">
                             {{ csrf_field() }}
                             {{--  
                                <input type="hidden" name="id" value="{{ $product->id }}" >
                             <input type="hidden" name="name" value="{{ $product->name }}">
                             <input type="hidden" name="price" value="{{ $product->sale_price }}" >
                             <div class="col-md-4 " >
                                <label for="quantity">Quantity:</label>
                                 <input  type="number" name="quantity" value ="1" max="{{ $product->quantity }}" class="form-control quantity-input quantity"> 
                            </div> 
                                --}}
                                <input type="hidden" name="id" value="{{ $products->id }}" >
                                <input type="hidden" name="name" value="{{ $products->name }}">
                                <input type="hidden" name="price" value="{{ $products->sale_price }}" >
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}" >
                                <div class="col-md-4 " >
                                    <label for="quantity">Quantity:</label>
                                     <input  type="number" name="quantity" value ="1" max="{{ $products->quantity }}" class="form-control quantity-input quantity"> 
                                </div>
                                                            
                            @if($products->quantity >0 )
                             <button class="btn btn-success"> 
                                    <span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
                                    </span> Sepete Ekle
                             </button>
                             <h5 style="color:#010305">Stockdaki Ürün Sayısı: {{$products->quantity}}<small style="color:#337ab7"></small></h5>
                            @else
                                <button class="btn btn-success" disabled> 
                                    <span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
                                    </span> Ürün Stokda Yok!!
                            </button> 

                            @endif
                                
                        </form>   
                        @else
                        <button class="btn btn-success" > 
                            <span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
                            </span> Giriş Yapmalısınız
                        </button>
                        @endif
                        
                    </div>
                                                        
                </div>                              
        
                <div class="col-xs-9">
                    <ul class="menu-items">
                        <li class="active">Ürün Açıklaması</li>
                    </ul>
                    <div style="width:100%;border-top:1px solid silver">
                        <p style="padding:15px;">
                            <big>
                                {{$products->description}}
                            </big>

                        </p>
                        <p style="padding:10px;">
                            {{$products->Depolama_Alani}}
                            {{$products->Yazar}}
                        </p>
                        <p style="padding:10px;">
                            {{$products->Ekran_Boyutu}}
                            {{$products->Çevirmen}}
                        </p>  
                        <p style="padding:10px;">
                            {{$products->Ram}}
                            {{$products->Sayfa_Sayisi}}
                        </p>
                        <p style="padding:10px;">
                            
                            {{$products->Baski_Sayisi}}
                        </p>
                        <p style="padding:10px;">
                            
                            {{$products->Dil}}
                        </p>
                        <p style="padding:10px;">
                            
                            {{$products->İlk_Baski_Yili}}
                        </p>
                                
                    </div>
                </div>		
            </div>
        </div>        
    </body>
    @endforeach
</html>
<script src="{{ asset('js/app.js')}}"></script>
<script>
</script>
@endsection