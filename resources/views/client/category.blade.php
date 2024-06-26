@extends('layouts.app')
@section('title', 'View Product')
@section('content')



    <style>
        .brand-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .brand-list li {
            display: inline-block;
            margin-right: 10px;
        }
    </style>

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



    <div class="address-container  d-flex justify-content-between align-items-center mt-4">

        <div class="address">
            <a href="/"> Home </a>/
            <a href="/product" class="h6 text-secondary"> Product </a>
        </div>

        <div class="col-sm-3">
            <div class="sort-container d-flex align-items-center ">
                <span class="h5 pr-5" style="width:100px ;">Sort By </span>

                <select name="sort__by" class="form-select form-select-lg btn--to__submit">
                    <option value=" Bestseller">Bestseller</option>
                    <option value="Discount">Discount</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                </select>

            </div>
        </div>
    </div>

    <section class="product-list" style="min-height:60vh ;">
        <div class="mt-4">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 "
                    style=" border-right: solid 0.5px rgba(108, 122, 137,0.5); ">


                    <div class=" dropdown mb-2" style="width: 100%; height:40px">
                        <div class="dropbtn btn-show-provider " style="width: 100%; height:100%">
                            <span>Provider</span>
                            <i class="fas fa-angle-down i-s-1"></i>
                            <i class="fas fa-angle-up i-s-2" style="display: none;"></i>
                        </div>
                        <div class="dropdown-content dropdown-content--provider " style="width: 100%;">
                            @if (isset($providers))
                                @foreach ($providers as $provider)
                                    <div class="  d-flex  align-items-center " style="width: 100%;height :40px">
                                        <input class="btn--to__submit" name="provider" value="{{ $provider->provider_id }}"
                                            type="checkbox" />
                                        <span style="margin-left: 10px;"> <b>{{ $provider->name }}</b></span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>



                    <div class=" dropdown mb-2" style="width: 100%; height:40px">
                        <div class="dropbtn btn-show-price" style="width: 100%; height:100%">
                            <span>Price</span>
                            <i class="fas fa-angle-down i-s-1--price"></i>
                            <i class="fas fa-angle-up i-s-2--price" style="display: none;"></i>
                        </div>
                        <div class="dropdown-content dropdown-content--price rounded-3 mt-2 fs-2"
                            style="width: 100%;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;">
                            <p><input class="btn--to__submit" name="price" value="5" type="radio"
                                    style="width: 20px;height: 20px;margin-left:2px">1 <svg width="30" height="30"
                                    style="margin-bottom: 8px">
                                    <use xlink:href="#arrow-right"></use>
                                </svg> 5 $</p>
                            <p><input class="btn--to__submit" name="price" value="10" type="radio">5 <svg
                                    width="30" height="30" style="margin-bottom: 8px">
                                    <use xlink:href="#arrow-right"></use>
                                </svg> 10 $</p>
                            <p><input class="btn--to__submit" name="price" value="15" type="radio">10 <svg
                                    width="30" height="30" style="margin-bottom: 8px">
                                    <use xlink:href="#arrow-right"></use>
                                </svg> 15 $</p>
                            <p><input class="btn--to__submit" name="price" value="20" type="radio">15 <svg
                                    width="30" height="30" style="margin-bottom: 8px">
                                    <use xlink:href="#arrow-right"></use>
                                </svg> 20 $</p>
                        </div>
                    </div>


                    <div class=" dropdown mb-2" style="width: 100%; height:40px">
                        <div class="dropbtn btn-show-type" style="width: 100%; height:100%">
                            <span>Type</span>
                            <i class="fas fa-angle-down i-s-1--type"></i>
                            <i class="fas fa-angle-up i-s-2--type" style="display: none;"></i>
                        </div>
                        <div class="dropdown-content dropdown-content--type " style="width: 100%;">
                            @if (isset($categories))
                                @foreach ($categories as $c)
                                    <div class="  d-flex  align-items-center " style="width: 100%;height :40px"><input
                                            class="btn--to__submit" name="category" value="{{ $c->category_id }}"
                                            type="checkbox"><b style="margin-left: 10px">{{ $c->name }}</b></div>
                                @endforeach
                            @endif

                        </div>
                    </div>


                </div>



                <div class=" col-sm-8 col-md-8 col-lg-9 col-xl-10 rounded-sm">
                    <div class="row">

                        <div id="message"></div>



                    </div>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="row " id="product-list">
                        @if (isset($products))
                            @foreach ($products as $product)
                                <div class="col col-xl-4 col-lg-4  col-md-6 col-sm-6 mt-2">

                                    <div class="product-item swiper-slide handleHover"
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
                                                    <div
                                                        class="d-flex align-items-center justify-content-between flex-row">
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
                                                <input type="hidden" name="product_id"
                                                    value="{{ $product->product_id }}" class="product_id">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn__add--card"
                                                style="background-color: #4a7246;font-size: 16px;color: #fff">Add to Cart
                                                <iconify-icon icon="uil:shopping-cart"></button>

                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="d-flex justify-content-center my-5"> <a href="{{ $products->previousPageUrl() }}"
                                class="fs-2 btn btn-outline-secondary" type="button">Back</a>
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <a style="margin: 0 10px;" href="http://localhost:8000/product?page={{ $i }}"
                                    class="fs-2 text-black ">{{ $i }}</a>
                            @endfor <a href="{{ $products->nextPageUrl() }}"
                                class="fs-2 btn btn--success d-block"
                                style="background-color: #4a7246;color:#fff">Next</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>





    {{-- sort by  --}}

    {{-- end sort by --}}






@endsection
