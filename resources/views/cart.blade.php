@extends('layouts.app')


@section('content')


<!DOCTYPE html>
<style>
    .shopping-cart{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.shopping-cart.dark{
	background-color: #f6f6f6;
}

.shopping-cart .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
}

.shopping-cart .block-heading{
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: center;
}

.shopping-cart .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.shopping-cart .dark .block-heading p{
	opacity:0.8;
}

.shopping-cart .block-heading h1,
.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
	margin-bottom:1.2rem;
	color: #3b99e0;
}

.shopping-cart .items{
	margin: auto;
}

.shopping-cart .items .product{
	margin-bottom: 20px;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .items .product .info{
    padding-left: 20px;
	padding-top: 0px;
	text-align: center;
}

.shopping-cart .items .product .info .product-name{
	font-weight: 600;
}

.shopping-cart .items .product .info .product-name .product-info{
	font-size: 14px;
	margin-top: 15px;
}

.shopping-cart .items .product .info .product-name .product-info .value{
	font-weight: 400;
}

.shopping-cart .items .product .info .quantity .quantity-input{
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price{
	margin-top: 15px;
    font-weight: bold;
    font-size: 22px;
 }

.shopping-cart .summary{
	border-top: 2px solid #5ea4f3;
    background-color: #f7fbff;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3{
	text-align: center;
	font-size: 1.3em;
	font-weight: 600;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type){
	padding-bottom: 10px;
	padding-top: 10px;
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text{
	font-size: 1em;
	font-weight: 600;
}

.shopping-cart .summary .price{
	font-size: 1em;
	float: right;
}

.shopping-cart .summary button{
	margin-top: 20px;
}

@media (min-width: 768px) {
	.shopping-cart .items .product .info {
		padding-top: 25px;
		text-align: left; 
	}

	.shopping-cart .items .product .info .price {
		font-weight: bold;
		font-size: 22px;
		top: 17px; 
	}

	.shopping-cart .items .product .info .quantity {
		text-align: center; 
	}
	.shopping-cart .items .product .info .quantity .quantity-input {
		padding: 4px 10px;
		text-align: center; 
	}
}

</style>    
<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<body>
    <title>Shopping Cart</title>
	<main class="page">
	 	<section class="shopping-cart dark">
	 		<div class="container">
		        <div class="block-heading">
		          <h2>Shopping Cart</h2>
		          
		        </div>

				@if (session()->has('success_message'))
					<div class="alert alert-success">
						{{ session()->get('success_message') }}
					</div>		
					
				@endif


				@if (count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error )
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>			
				@endif

				

				{{-- 
					@if(Cart::count() >0)
					{{ Cart::count()}} items in shopping cart</h2>
					--}}
				
				
				@if($Carts->count())
					<h2>{{ ShowCartCount(Auth::id())}} items in shopping cart</h2>
					
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-lg-8">
								<div class="items">
								@foreach ( $Carts as $row )
									
									
									<div class="product">
									   <div class="row">
										   
										   <div class="col-md-3">
											   <a href="{{ route('product.show', $row->id) }}">
											   <img class="imimageg-fluid mx-auto d-block "  style="width:100%" src="{{$row->image_name}}"></a>
										   </div>
										   <div class="col-md-8">
											   <div class="info">
												   <div class="row">
													   <div class="col-md-5 product-name">
														   <div class="product-name">
															   <a>{{ $row->name}}</a>
															   <div class="product-info">
																   <a>{{ $row->quantity }}</a>
																   <form action="{{ route("cart.destroy",$row->id) }}" method="POST">	
																	{{ csrf_field() }}
																	<input type="hidden" name="user_id" value="{{ Auth::id() }}" >
																	{{ method_field("DELETE") }}
																	<button type="submit" class="btn btn-primary btn-lg btn-block">Remove</button>
																	<a>{{ $row->product_quantity }}</a>
																	
																	</form>
																  
															   </div>
														   </div>
													   </div>
													   <div class="col-md-4 " >
														   <label for="quantity">Quantity:</label>

														   <input data-id="{{$row->id}}" type="number"  value ="{{ $row->product_quantity }}" max="{{$row->quantity }}" class="form-control quantity-input quantity"> 
															
													   </div>
													   <div class="col-md-3 price">
														   <span>
															{{ number_format($row->product_quantity*$row->sale_price,2) }}
															TL</span>
													   </div>
												   </div>
											   </div>
										   </div>
									   </div>
								   </div>	
									@endforeach
									
						
									<div class="col-md-12 col-lg-4">
										<div class="summary">
											<h3>Summary</h3>
											{{-- <div class="summary-item"><span class="text">Subtotal</span><span class="price">{{ Cart::subtotal() }}</span></div> --}}
											
											<div class="summary-item " >
												<span class="text">Total</span>
												<span class="price">{{ CartTotal(Auth::id()) }}</span>
											</div>

											<form action="{{ route("cart.edit",Auth::id()) }}" method="POST">	
												{{ csrf_field() }}
												{{ method_field("PATCH") }}
												<button type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>	
											</form>
										</div>
									</div>
						</div> 
					</div>
					
					
				
				@else
					<h3>No items in cart </h3>
				@endif
		        
	 		</div>
		</section>

    </main>
</body>    
</html>


	<script src="{{ asset('js/app.js')}}"></script>
	<script>
		(function(){
			const classname = document.querySelectorAll('.quantity')

			Array.from(classname).forEach(function(element){
				element.addEventListener('change',function(){
					console.log($(this).attr('data-id'));
					console.log({{ Auth::id() }});
					console.log(this.value);
					axios.patch('/cart/'+$(this).attr('data-id'),{
						quantity: this.value,
						use_id: {{ Auth::id() }},
						
					})
					.then(function(response){
						console.log(response);
						window.location.href = '{{ route('cart.index') }}'
					})
					.catch(function(error){
						console.log(error);
					})
				})
			})

		})();

		
	</script>
	






@endsection
