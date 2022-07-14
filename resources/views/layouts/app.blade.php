<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script>-->
    


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <style>
        body {
            background-color:white;
            margin:0;
        }

        .header {
            background-color: #f1f1f1;
            padding: 0px;
            text-align: center;
        
        }

        ul.top{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position:static;
            top: 0;
            width: 100%;
        }

        li.top {
            float: left;
            border-right:1px solid #bbb;
            
        }

        li.top:last-child {
            border-right: none;
        }

        li.top a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #38444d;
            
        }

        li.topnav{
            float:left
        }

        li.topnav a, .dropbtn{
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
             text-decoration: none;
        }

        li.topnav a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        li.dropdown {
            display: inline-block;
        }

        div.dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        div.dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        div.dropdown-content a:hover {background-color: #f1f1f1;}
        li.dropdown:hover div.dropdown-content {
            display: block;
        }

    </style>  
</head>
<body>
    <div id="app">
       <div class= "header">
        <ul class = "top">
            <li class="top">
                <a href="{{ url('/') }}">
                Laravel 
                </a>
            </li>
            <!--<li class = "top"><a href="#news">News</a></li>-->
            @guest
                @if (Route::has('register'))
                    <li class = "top" style="float:right"><a href="{{ route('register') }}">Register</a></li>
                @endif

                @if (Route::has('login'))
                    <li class = "active top" style="float:right"><a href="{{ route('login') }}">Login</a></li>
                @endif

            @else
                <li class = "top" style="float:right" >
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                    </form>
                </li>
                <li class = "top" style="float:right" ><a href = "{{ route("cart.index") }}">{{ Auth::user()->name }}</a></li>
                
            @endguest    
            
        </ul>
       </div>   
        
        <ul class="topnav">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn" >Kitap</a> 
                <div class = "dropdown-content">
                    <a href="{{route('edebiyat.index') }}">Edebiyat</a>
                    <a href="{{route('roman.index') }}">Roman</a>
                    <a href="{{route('bilim.index') }}">Bilim</a>  
                </div>
            </li>
            <li class="topnav"><a href="#home">Yabancı Kitap</a> </li>
            <li class="topnav"><a href="#home">Çoçuk Kitapları</a> </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn" >Elektronik</a> 
                <div class = "dropdown-content">
                    <a href="{{route('phone.index') }}">Cep Telefonları</a>
                    <a href="{{route('smartwatch.index') }}">Akıllı Saatler</a>
                    <a href="{{route('tablet.index') }}">Tablet ve Aksesuarları</a>  
                </div>
            </li>
            <li class="topnav"><a href="#home">Hobi & Oyuncak</a> </li>
            <li class="topnav"><a href="#home">Kırtasiye</a> </li>
            <li class="topnav"><a href="#home">Oyun & Konsol</a> </li>    
        </ul>
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
