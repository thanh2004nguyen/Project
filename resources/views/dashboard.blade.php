@extends('layouts.app')
@section('title', 'View Product')
@section('content')
    <style>
        .carousel-caption {
            position: absolute;
            top: 70%;
            /* Đặt phần trên của văn bản ở giữa */
            left: 20%;
            /* Đặt phần trái của văn bản ở giữa */
            transform: translate(-50%, -50%);
            /* Dịch chuyển văn bản ngược lại 50% kích thước của nó */
            background-color: rgba(243, 159, 159, 0.236);
            /* Tạo nền mờ cho văn bản để làm nổi bật */
            color: rgba(0, 0, 0, 0.5);
            /* Màu văn bản */
            /* padding: 50px; */
            /* Khoảng cách từ viền nền đến văn bản */
            width: 300px;
            height: 200px;

        }
    </style>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <!-- !Carousel/Slider -->
    <div class="mt-5  ">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">

                @for ($i = 0; $i < count($banner); $i++)
                    <div class="carousel-item @if ($i == 0) {{ 'active' }} @endif">
                        <div class="d-flex justify-content-center ">

                            <img class="d-block rounded-2" style="width:90vw;height: 60vh;"
                                src="{{ $banner[$i]->banerURL }}" alt="Second slide">
                            {{-- <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $i }}slide label</h5>
                                <p>Some representative placeholder content for the {{ $i }} slide.</p>
                            </div> --}}
                        </div>
                    </div>
                @endfor


            </div>

            <button class="carousel-control-prev " type="button" data-bs-target="##arouselExampleCaptions"
                data-bs-slide="prev">
                <span aria-hidden="true">
                    <div class="btn-circle" style="background-color:#4bba41; "><i
                            class="fa-solid fa-chevron-left text-black" id="btn-prev"></i></div>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span aria-hidden="true">
                    <div class="btn-circle" style="background-color:#4bba41; "><i
                            class="fa-solid fa-chevron-right  text-black" id="btn-next"></i></div>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    </div>
    {{-- Top Selling --}}

    {{-- icon --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <defs>
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
            </symbol> --}}
            <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
            </symbol>
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
            </symbol> --}}
            <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24" style="color: black">
                <path fill="currentColor"
                    d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
            </symbol>
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
                <path fill="currentColor"
                    d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z" />
            </symbol> --}}
            {{-- <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
                <path fill="currentColor"
                    d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
            </symbol> --}}
        </defs>
    </svg>
    {{-- icon --}}

    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-lg-12 pt-2 m-auto text-center d-flex justify-content-center flex-column">
                        <h1 style="d-block">Top Selling</h1>
                        <hr class="product-title" style="float:left">
                    </div>
                    <div class="section-header d-flex justify-content-end mb-2">

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All →</a>
                            <div class="swiper-buttons d-flex flex-row ">
                                <button class="swiper-prev products-carousel-prev border-0 outline-none mx-1">❮</button>
                                <button class="swiper-next products-carousel-next border-0 outline-none">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12">

                    <div class="products-carousel swiper">
                        <div class="swiper-wrapper">
                            @foreach ($topProducts as $top)
                                <div class="product-item swiper-slide"
                                    style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
                                    <a href="{{ route('wishlist', ['product_id' => $top->product_id]) }}"
                                        class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="{{ route('product.detail', ['id' => $top->product_id]) }}"
                                            title="Product Title">
                                            <div class="rounded-2 overflow-hidden">

                                                <img src="{{ $top->images[0]->url }}"
                                                    style="object-fit: cover;width: 11rem; height: 11rem"
                                                    class="rounded mx-auto d-block">
                                            </div>
                                        </a>
                                    </figure>
                                    <div class="text-center">

                                        <h3> {{ $top->name }}</h3>
                                    </div>
                                    {{-- <span class="qty">1 Unit</span> --}}
                                    {{-- rating --}}
                                    <div class="rating" style="height: 2rem">
                                        @php
                                            $rating = $top->avgrating(); // Retrieve the rating value from the database
                                            $fullStars = floor($rating); // Get the number of full stars
                                            $halfStar = ceil($rating - $fullStars); // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Calculate the number of empty stars
                                        @endphp
                                        @if ($rating > 0)
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fa-solid fa-star"
                                                    style="font-size:20px; color:hsl(47 100% 62%) !important"></i>
                                            @endfor
                                            @if ($halfStar)
                                                <i class="fa-regular fa-star-half-stroke"
                                                    style="font-size:20px;color:hsl(47 100% 62%) !important"></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="fa-regular fa-star" style="font-size:20px;"></i>
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa-regular fa-star" style="font-size:20px;"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    {{-- rating --}}
                                    <div class="text-center">

                                        <span
                                            class="border border-2 px-3 rounded-3 fs-4 fw-bold">${{ $top->price }}</span>
                                    </div>


                                    <form action="{{ route('cart.add') }}" method="POST"
                                        class="d-flex align-items-center justify-content-between flex-column"
                                        style="width: 100%;">
                                        @csrf

                                        <div class="mb-2" style="width: 100%">
                                            <div class="d-flex  justify-content-between flex-row">
                                                <span class="d-block fw-bold">Stock: {{ $top->quantity }}</span>
                                                <div class="d-flex align-items-center justify-content-between flex-row">
                                                    <div class="input-group product-qty">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="quantity-left-minus btn btn-danger btn-number"
                                                                data-type="minus" data-field="">
                                                                <svg width="16" height="16">
                                                                    <use xlink:href="#minus"></use>
                                                                </svg>
                                                            </button>
                                                        </span>
                                                        <input type="text" id="quantity" name="quantity"
                                                            class="form-control input-number fw-medium" value="1"
                                                            min="1" max="100">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="quantity-right-plus btn btn-success btn-number"
                                                                data-type="plus" data-field="">
                                                                <svg width="16" height="16">
                                                                    <use xlink:href="#plus"></use>
                                                                </svg>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $top->product_id }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: #4a7246;font-size: 16px;color: #fff">Add to Cart
                                            <iconify-icon icon="uil:shopping-cart"></button>

                                    </form>




                                    {{-- <div class="product-item swiper-slide" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
                                    <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="product-single.html" title="Product Title">
                                            <img src="images/thumb-tomatoketchup.png" class="tab-image">
                                        </a>
                                    </figure>
                                    <h3>Sunstar Fresh Melon Juice</h3>
                                    <span class="qty">1 Unit</span><span class="rating"><svg width="24"
                                            height="24" class="text-primary">
                                            <use xlink:href="#star-solid"></use>
                                        </svg> 4.5</span>
                                    <span class="price">$18.00</span>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="input-group product-qty">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#minus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number" value="10" min="1"
                                                max="100">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-success btn-number"
                                                    data-type="plus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#plus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                        <a href="#" class="nav-link">Add to Cart <iconify-icon
                                                icon="uil:shopping-cart"></a>
                                    </div>
                                </div> --}}


                                </div>
                            @endforeach
                        </div>
                        <!-- / products-carousel -->

                    </div>
                </div>
            </div>
    </section>
    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-lg-12 pt-2 m-auto text-center d-flex justify-content-center flex-column">
                        <h1 style="d-block">New Arrival</h1>
                        <hr class="product-title" style="float:left">
                    </div>
                    <div class="section-header d-flex justify-content-end mb-2">

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All →</a>
                            <div class="swiper-buttons d-flex flex-row ">
                                <button class="swiper-prev products-carousel-prev border-0 outline-none mx-1">❮</button>
                                <button class="swiper-next products-carousel-next border-0 outline-none">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12">

                    <div class="products-carousel swiper">
                        <div class="swiper-wrapper">
                            @foreach ($newProducts as $product)
                                <div class="product-item swiper-slide"
                                    style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
                                    <a href="{{ route('wishlist', ['product_id' => $product->product_id]) }}"
                                        class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="{{ route('product.detail', ['id' => $product->product_id]) }}"
                                            title="Product Title">
                                            <div class="rounded-2 overflow-hidden">

                                                <img src="{{ $product->images[0]->url }}"
                                                    style="object-fit: cover;width: 11rem; height: 11rem"
                                                    class="rounded mx-auto d-block">
                                            </div>
                                        </a>
                                    </figure>
                                    <div class="text-center">

                                        <h3> {{ $product->name }}</h3>
                                    </div>
                                    {{-- <span class="qty">1 Unit</span> --}}
                                    {{-- rating --}}
                                    <div class="rating" style="height: 2rem">
                                        @php
                                            $rating = $product->avgrating(); // Retrieve the rating value from the database
                                            $fullStars = floor($rating); // Get the number of full stars
                                            $halfStar = ceil($rating - $fullStars); // Check if there is a half star
                                            $emptyStars = 5 - ($fullStars + $halfStar); // Calculate the number of empty stars
                                        @endphp
                                        @if ($rating > 0)
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fa-solid fa-star"
                                                    style="font-size:20px; color:hsl(47 100% 62%) !important"></i>
                                            @endfor
                                            @if ($halfStar)
                                                <i class="fa-regular fa-star-half-stroke"
                                                    style="font-size:20px;color:hsl(47 100% 62%) !important"></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="fa-regular fa-star" style="font-size:20px;"></i>
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa-regular fa-star" style="font-size:20px;"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    {{-- rating --}}
                                    <div class="text-center">

                                        <span
                                            class="border border-2 px-3 rounded-3 fs-4 fw-bold">${{ $product->price }}</span>
                                    </div>


                                    <form action="{{ route('cart.add') }}" method="POST"
                                        class="d-flex align-items-center justify-content-between flex-column"
                                        style="width: 100%;">
                                        @csrf

                                        <div class="mb-2" style="width: 100%">
                                            <div class="d-flex  justify-content-between flex-row">
                                                <span class="d-block fw-bold">Stock: {{ $product->quantity }}</span>
                                                <div class="d-flex align-items-center justify-content-between flex-row">
                                                    <div class="input-group product-qty">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="quantity-left-minus btn btn-danger btn-number"
                                                                data-type="minus" data-field="">
                                                                <svg width="16" height="16">
                                                                    <use xlink:href="#minus"></use>
                                                                </svg>
                                                            </button>
                                                        </span>
                                                        <input type="text" id="quantity" name="quantity"
                                                            class="form-control input-number fw-medium" value="1"
                                                            min="1" max="100">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="quantity-right-plus btn btn-success btn-number"
                                                                data-type="plus" data-field="">
                                                                <svg width="16" height="16">
                                                                    <use xlink:href="#plus"></use>
                                                                </svg>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: #4a7246;font-size: 16px;color: #fff">Add to Cart
                                            <iconify-icon icon="uil:shopping-cart"></button>

                                    </form>




                                    {{-- <div class="product-item swiper-slide" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
                                    <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                            <use xlink:href="#heart"></use>
                                        </svg></a>
                                    <figure>
                                        <a href="product-single.html" title="Product Title">
                                            <img src="images/thumb-tomatoketchup.png" class="tab-image">
                                        </a>
                                    </figure>
                                    <h3>Sunstar Fresh Melon Juice</h3>
                                    <span class="qty">1 Unit</span><span class="rating"><svg width="24"
                                            height="24" class="text-primary">
                                            <use xlink:href="#star-solid"></use>
                                        </svg> 4.5</span>
                                    <span class="price">$18.00</span>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="input-group product-qty">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#minus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number" value="10" min="1"
                                                max="100">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-success btn-number"
                                                    data-type="plus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#plus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                        <a href="#" class="nav-link">Add to Cart <iconify-icon
                                                icon="uil:shopping-cart"></a>
                                    </div>
                                </div> --}}


                                </div>
                            @endforeach
                        </div>
                        <!-- / products-carousel -->

                    </div>
                </div>
            </div>
    </section>
    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-lg-12 pt-2 m-auto text-center d-flex justify-content-center flex-column">
                        <h1 style="d-block">The Lastest Blogs</h1>
                        <hr class="product-title" style="float:left">
                    </div>
                    <div class="section-header d-flex justify-content-end mb-2">

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn-link text-decoration-none">View All →</a>
                            <div class="swiper-buttons d-flex flex-row ">
                                <button class="swiper-prev products-carousel-prev border-0 outline-none mx-1">❮</button>
                                <button class="swiper-next products-carousel-next border-0 outline-none">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12 ">

                    <div class="products-carousel swiper ">
                        <div class="swiper-wrapper ">
                            @foreach ($blog as $top)
                                <div class="product-item swiper-slide "
                                    style="width:40rem;height: 20rem;box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">

                                    <figure style="height: 70%;width: 100%;">
                                        <a href="{{ route('product.detail', ['id' => $top->blog_id]) }}"
                                            title="Product Title">
                                            <div class="rounded-2 overflow-hidden" style="height: 100%;width: 100%">

                                                <img src="{{ count($top->images) > 0 ? url($top->images[0]->url) : 'khong co' }}"
                                                    style="object-fit: cover;width: 100%; height: 100%"
                                                    class="rounded mx-auto d-block">
                                            </div>
                                        </a>
                                    </figure>
                                    <div class="text-center">

                                        <h3>{{ $top->hagtag }}</h3>
                                    </div>

                                    <a href="{{ route('product.detail', ['id' => $top->blog_id]) }}"
                                        class="btn btn-primary"
                                        style="background-color: #4a7246;font-size: 16px;color: #fff">Read
                                        <iconify-icon icon="uil:shopping-cart" /></a>






                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
    </section>

@endsection
