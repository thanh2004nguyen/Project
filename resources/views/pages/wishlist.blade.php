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
            padding: 50px;
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






    {{-- <section class="category">
        <div id="category-title">Our Partners</div>
        <div class="category-container">
            <div class="row py-3 justify-content-center align-items-end" style="margin: 0;">
                @foreach ($brands as $brand)
                <div class="col-sm-3">
                    <div class="category-wrapper" style="width: 18rem;">
                        <img src="{{ $brand->logo}}"
                                alt="{{ $brand->image}}  " data-image="{{ $brand->image }}"
                                 width="70%" height="200vw"><br>
                        <a href="{{ URL::to('/brand-product/' . $brand->id) }}" name="name" style="color: black; font-size: 25px ;font-weight: 700" >{{ $brand->name }}</a><br>
                    </div>
                </div>
                @endforeach
                
    </section> --}}
    {{-- icon --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
            </symbol>
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
        </defs>
    </svg>
    <section class="product">
        <!-- !att1.5 -->
        <div class="col-lg-12 pt-5 m-auto text-center">
            <h1 style="text-align: left">WishList</h1>
            <hr class="product-title" style="float:left">
            @foreach ($wishlist as $top)
            @endforeach
        </div>
        <div class="products-container">
            <div id="card-slider0" class="carousel carousel-dark slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            @foreach ($wishlist as $top)
                                <div class="col col-xl-4 col-lg-4  col-md-6 col-sm-6 mt-2">

                                    <div class="product-item swiper-slide handleHover"
                                        style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
                                        <a href="{{ route('wishlist', ['product_id' => $top->product_id]) }}"
                                            class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="{{ route('product.detail', ['id' => $top->product_id]) }}"
                                                title="Product Title">
                                                <div class="rounded-2 overflow-hidden">

                                                    <img src="{{ $top->product->images[0]->url }}"
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
                                                $rating = $top->rating; // Retrieve the rating value from the database
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
                                                class="border border-2 px-3 rounded-3 fs-4 fw-bold">${{ $top->product->price }}</span>
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
                                                                class="form-control input-number fw-medium cart-quantity"
                                                                value="1" min="1" max="100">
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
                                                <input type="hidden" name="product_id" value="{{ $top->product_id }}"
                                                    class="product_id">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn__add--card"
                                                style="background-color: #4a7246;font-size: 16px;color: #fff">Add to Cart
                                                <iconify-icon icon="uil:shopping-cart"></button>

                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{--     
     <div class="col-lg-12 pt-5 m-auto text-center">
        <h1 style="text-align: left">The Lastest Blogs</h1><hr class="product-title" style="float:left" >
    </div>
    <div class="products-container">
        <div id="card-slider0" class="carousel carousel-dark slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row justify-content-center">
                    @foreach ($blog as $top)
                    <div class="col-lg-4" ng-repeat="top in slist">
                        <div class="card border-0 bg-light mb-2">
                            <div class="card-body">
                              <a href="">
                             
                              <img src="{{count($top->images)>0 ? url('img/'.$top->images[0]->url):"khong co"}}" style="width:250px ;height:250px" 
                                href="{{ route('product.detail', ['id' => $top->blog_id]) }}"></a>
                              {{-- <a href="{{URL::to('/nuts')}}"> --}}
        {{-- <div class="content"> 
                                <a href="{{ route('product.detail', ['id' => $top->blog_id]) }}">
                            
                                <div class="card-info">
                                  {{ $top->hagtag }}<br>
                                  </div></a>
                                  <p>{!! $top->content !!}</p>
                                  <a href="#" class="read-more-btn icon-space-left">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
                    
                    @endforeach
                </div>  --}}


        {{-- End !att3 --}}


    </section>

@endsection
