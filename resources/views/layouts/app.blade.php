<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/chattle_style.min.css') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    
    
    {{-- hien --}}
    <link rel="stylesheet" href="{{ asset('fontend/CSS/css_1.css') }}"><!--CSS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <link rel="stylesheet" href="{{ asset('fontend/CSS/checkout.css') }}">
    
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
   


</head>


<body class="font-sans antialiased">
    <div id="chat_box">

        @include('chat.chat')
    </div>
    <div style="position: relative , z-index:100000;">

        @include('layouts.navigation')
    </div>
    <div class="container">
        <section id='main_content'>
            @yield('content')
        </section>
    </div>
    @include('layouts.footer')




    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    {{-- chatbox --}}
    

   


<script src="{{ asset('fontend/JS/script.js') }}"></script>
<script src="{{ asset('fontend/JS/location.js') }}"></script>
<script src="{{ asset('fontend/JS/oldaddress.js') }}"></script>
<script src="{{ asset('fontend/JS/paypal.js') }}"></script>
<script src="{{ asset('fontend/JS/freeship.js') }}"></script>

    {{-- end chat box --}}
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>

  
    <script src="/js/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
    integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="/js/jquery-cookie.js"></script>
    <script src="/js/chattle_customer.js"></script>
    <script src="/js/handleLogout.js"></script>

    <script src="/js/handleMenu.js"></script>
    <script src="/js/handleSort.js"></script>
    <script src="/js/handleAddCart.js"></script>
   

</body>

</html>
