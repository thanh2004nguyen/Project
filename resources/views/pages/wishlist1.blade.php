@extends('layouts.app')
@section('title', 'View Product')
@section('content')
<style>
    .carousel-caption {
        position: absolute;
        top: 70%; /* Đặt phần trên của văn bản ở giữa */
        left: 20%; /* Đặt phần trái của văn bản ở giữa */
        transform: translate(-50%, -50%); /* Dịch chuyển văn bản ngược lại 50% kích thước của nó */
        background-color:rgba(243, 159, 159, 0.236) ; /* Tạo nền mờ cho văn bản để làm nổi bật */
        color: rgba(0, 0, 0, 0.5); /* Màu văn bản */
        padding: 50px; /* Khoảng cách từ viền nền đến văn bản */
        width: 300px;
        height:200px;
           
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
                @foreach($brands as $brand)
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

    <section class="product">
        <!-- !att1.5 -->
            <div class="col-lg-12 pt-5 m-auto text-center">
            <h1 style="text-align: left">WishList</h1><hr class="product-title" style="float:left" >
            @foreach ($wishlist as $top)
        
            @endforeach
        </div>
        <div class="products-container">
            <div id="card-slider0" class="carousel carousel-dark slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="row justify-content-center">
                    @foreach ($wishlist as $top)
                      <div class="col-lg-4" ng-repeat="top in slist">
                          <div class="card border-0 bg-light mb-2">
                              <div class="card-body">
                                <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                                <img src="{{$top->product->images[0]->url}}"
                                width="250px" height="250px" alt="{{ $top->product}}" href="{{ route('product.detail', ['id' => $top->product_id]) }}">
                                {{-- <a href="{{URL::to('/nuts')}}"> --}}
                                    <a href="{{ route('product.detail', ['id' => $top->product_id]) }}">
    
                                  <div class="card-info">
                                    {{ $top->product->name }}<br>
                             
                                 
                                        <div class="rating">
                                            @php
                                                $rating = $top->product->avgrating(); // Retrieve the rating value from the database
                                                $fullStars = floor($rating); // Get the number of full stars
                                                $halfStar = ceil($rating - $fullStars); // Check if there is a half star
                                                $emptyStars = 5 - ($fullStars + $halfStar); // Calculate the number of empty stars
                                            @endphp
                                                          @if( $rating > 0)
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                            @if ($halfStar)
                                                <i class="fa-regular fa-star-half-stroke"></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor
                                            @endif
                                        </div>
                                      <div class="price">
                                       Pice:  {{ $top->product->price}} đ <br>
                                   
                                       
                                      </div>
                                      <br>
                                  </div>
                                </a>
                                {{-- add to cart --}}
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <div class="buy-action">
                                        <div class="quantity">
                                           <span style="color: rgb(8, 27, 240)">Stock:{{ $top->product->quantity}} </span>    <input type="number" class="cart-quantity" min="1" value="1" max="100" name="quantity">
                                        </div>
    
                                        <input type="hidden" name="product_id" value="{{ $top->product_id }}">
    
                                        <div class="wishlist">
                                            <a href="{{ route('wishlist', ['product_id' => $top->product_id]) }}"><i class="fa-regular fa-heart"></i></a>
                                        </div>
    
                                        <div class="add-to-cart">
                                            <button type="submit"  >Add to cart</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- add to cart --}}
                              </div>
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


