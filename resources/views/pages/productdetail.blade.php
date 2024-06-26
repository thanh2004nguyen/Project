@extends('layouts.app')
@section('title','Product List')
@section('content')

<link rel="stylesheet" href="{{ asset('fontend/CSS/detailThien.css')}}">
<link rel="stylesheet" href="{{ asset('fontend/CSS/detail.css')}}">
<link rel="stylesheet" href="{{ asset('fontend/CSS/product.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('fontend/CSS/css_1.css')}}"> --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

{{-- Thanh --}}
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title" >Product Details</h3>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up"  data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive" >
                                        <div class="image" style="height: 450px;">
                                            <img id="main-image"  src="{{ asset($product->images[0]->url) }}" 
                                            alt="{{$product->images[0]->url}}" >
                                        </div>                                    </div>
                                </div>
                        </div>
                        <!-- End Large Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"  data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            {{-- name --}}
                            <h4 class="title"><span>{{ $product->name}}</span></h4>
                 
                                    <div class="rating" style="width: 40%;">
                                        <ul>
                                        @php
                                            $rating = $product->avgrating(); // Retrieve the rating value from the database
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
                                        @else 
                                        <i>No one review yet!</i>
                                        @endif
                                    </div>

                            <div class="price">${{ number_format($product->price / 1, 2, '.', ',') }}</div>
                          
                            <!-- Start  Product Details Catagories Area-->
                
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"></span> {{$product->quantity}} PRODUCTS IN STOCK</div>
                            </div>
                            <!-- End  Product Details Catagories Area-->

                        </div> <!-- End  Product Details Text Area-->   
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">More Images</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span></div>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-variable-color">
                                
                          <div class="product-images">
                                        @foreach ($product->images as $p)
                                          <img style="width: 50px; height: 50px;" class="thumbnail-image" src="{{ asset($p->url) }}" alt="{{ 'fontend/Image/cay-luoi-ho2.jpg' }}">
                              
                                        @endforeach
                                      </div>

                                </div>
                            </div>

                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <div class="product-add-to-cart-btn">

                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                                <div class="buy-action" >
                                                    <div class="quantity" style="visibility: hidden; display: none;">
                                                        <input type="number" class="cart-quantity" min="1" value="1" name="quantity">
                                                    </div>

                                                    <input  style="visibility: hidden; display: none;" type="hidden" name="product_id" value="{{ $product->product_id }}">

                                                    <div class="wishlist"  style="visibility: hidden; display: none;">
                                                        <a href="#!wishlist"><i class="fa-regular fa-heart"></i></a>
                                                    </div>

                                                    <div class="add-to-cart">
                                                        <button class="" type="submit"  >Add to cart</button>
                                                    </div>
                                                </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Start  Product Details Meta Area-->
                        </div> <!-- End Product Variable Area -->

                        <!-- Start  Product Details Social Area-->
                        <div class="product-details-social">
                            <span class="title">SHARE THIS PRODUCT:</span>
                            {{-- share facebook --}}
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0" nonce="zcl94d34"></script>
                            <div class="fb-share-button" data-href="" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=" class="fb-xfbml-parse-ignore">Share</a></div>

                         <!-- End  Product Details Social Area-->
                    </div>
</div> <!-- End  Product Details Social Area-->
                    </div>
                </div>
            </div>
        </div>
    </div>




{{-- review --}}
<div class="product-details-content-tab-section section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-content-tab-wrapper" data-aos="fade-up"  data-aos-delay="0">

                    <!-- Start Product Details Tab Button -->
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                Description
                            </a></li>
                        {{-- <li><a class="nav-link" data-bs-toggle="tab" href="#specification">
                                Specification
                            </a></li> --}}
                        <li><a class="nav-link" data-bs-toggle="tab" href="#review">
                                Reviews {{--({{ count($product->productComments) }})--}}
                            </a></li>
                    </ul> <!-- End Product Details Tab Button -->

                    <!-- Start Product Details Tab Content -->
                    <!-- Instruction Content -->
                    <div class="product-details-content-tab-section section-top-gap-100">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="product-details-content-tab-wrapper" data-aos="fade-up"  data-aos-delay="0">
                
                                     
                
                                        <!-- Start Product Details Tab Content -->
                                        <div class="product-details-content-tab">
                                            <div class="tab-content">
                                                <!-- Start Product Details Tab Content Singel -->
                                                <div class="tab-pane active show" id="description">
                                                    <div class="single-tab-content-item" id="compare_productdes{{$product->id}}" value="{{$product->description}}">
                                                        <p>{!! $product->description!!}</p>
                                                        
                                                    </div>
                                                </div> 
                                                <!-- Start Product Details Tab Content Singel -->
                                                <div class="tab-pane" id="review">
                                                    <div class="single-tab-content-item">
                                                        <!-- Start - Review Comment -->
                                                        <ul class="comment">
                                                
                                                            <!-- Start - Review Comment list-->
                                                            <li class="comment-list">
                                                               @foreach($product->review as $review)
                                                                    <div class="comment-wrapper"> 
                                                                        <div class="comment-img">
                                                                            <img src="{{ $review->user->avatar ? url('/img/animal_avatar/'.$review->user->avatar. '.png') : url('/img/animal_avatar/rabbit.png') }}" alt="">
                                                                        </div>
                                                                        <div class="comment-content">
                                                                            <div class="comment-content-top">
                                                                                <div class="comment-content-left">
                                                                                    <h6 class="comment-name">{{$review->user->name}}</h6>
                                                                                    <ul class="review-star">
                                                                                        <div class="rating" style="width: 100%;">
                                                                                            <ul>
                                                                                            @php
                                                                                                $rating = $review->rating; 
                                                                                                $fullStars = floor($rating); 
                                                                                                $halfStar = ceil($rating - $fullStars); 
                                                                                                $emptyStars = 5 - ($fullStars + $halfStar); 
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
                                                                                            @else 
                                                                                            <i>No one review yet!</i>
                                                                                            @endif
                                                                                        </div>
                                                                                    </ul>
                                                                                </div>
                                                                                 {{-- <div class="comment-content-right">
                                                                                    <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                                </div> --}}
                                                                            </div>
                                                                            <div class="para-content">
                                                                                <p>{!!$review->comment!!}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($review->admin_comment != null)
                                                                        <!-- Start - Review Comment Reply-->
                                                                        <ul class="comment-reply">
                                                                            <li class="comment-reply-list">
                                                                                <div class="comment-wrapper">
                                                                                    <div class="comment-img">
                                                                                        <img src="{{ asset('img/admin.png') }}" alt="">
                
                                                                                    </div>
                                                                                    <div class="comment-content">
                                                                                        <div class="comment-content-top">
                                                                                            <div class="comment-content-left">
                                                                                                <h6 class="comment-name">TREE ONE</h6>
                                                                                            </div>
                                                                                        </div>
                
                                                                                        <div class="para-content">
                                                                                            <p>{!!$review->admin_comment!!}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul> <!-- End - Review Comment Reply-->
                                                                    @endif
                
                                                                @endforeach
                                                            </li> <!-- End - Review Comment list-->
                                                        </ul> <!-- End - Review Comment -->
                                                      
                                                    </div>
                                                </div> <!-- End Product Details Tab Content Singel -->
                                            </div>
                                        </div> <!-- End Product Details Tab Content -->
                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-default-slider-section section-fluid section-inner-bg">
                        <!-- Start Section Content Text Area -->
                        <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="section-content-gap">
                                            <div class="secton-content">
                                                <h3  class="section-title">RELATED PRODUCTS</h3>
                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Start Section Content Text Area -->
                        <div  class="" data-aos="fade-up"  data-aos-delay="0">
                            <div class="container">
                                <div class="row">
                                    
                                 
                                    <div class="col-12">
                                        <div class="product-slider-default-1row default-slider-nav-arrow">
                                            <!-- Slider main container -->
                                            <div class="swiper-container product-default-slider-4grid-1row">
                                                <!-- Additional required wrapper -->
                                                <div class="swiper-wrapper">
                                                   
                                                    @foreach ($relatePro as $p)
                                                    <!-- End Product Default Single Item -->
                                                    <!-- Start Product Default Single Item -->
                                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                                        
                                                        <div class="image-box">
                                                            
                                                            @if ($p->quantity == 0)
                                                            <div class="image-container">
                                                                <div class="sold-out-label" style="opacity: 1">Sold Out</div>
                                                                <img style="opacity: 0.2" src=" {{url($p->images[0]->url)}} " alt=""/>
                                                            </div>
                                                            @else
                                                            <a href="{{url($p->product_id)}}" class="image-link" id="compareurl{{$p->product_id}}">
                                                                <img style="width:20%;height:20%" id="comparepic{{$p->product_id}}" src='{{url($p->images[0]->url)}} '/>
                                                            
                                                 
                                                    </a>
                                                    @endif
                                                    <div class="action-link" style="width:20%;height:40%">
                                                           <form action="{{ route('cart.add') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $p->product_id }}" />
                                                           
                                                            <button type="submit" class="btn btn-primary">Add to cart </button>
                                                        </form>
                                                      
                                                      
                                                      
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="content-left">
                                                    <span class="price">{{$p->name}}</span>
                                                   <span class="price">${{$p->price}}</span>
                                                
                                                        {{-- <h6 class="title"><a href="{{url('front/productdetails/'.$items->id)}}">{{$items->name}}</a></h6> --}}
                                                        <div class="rating" style="width: 40%;">
                                                            <ul>
                                                            @php
                                                                $rating = $product->avgrating(); // Retrieve the rating value from the database
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
                                                            @else 
                                                            {{-- <i>No one review yet!</i> --}}
                                                            @endif
                                                        </div>
                                                    </ul>
                                                </div>
                                                <div class="content-right">
                                              
                                                </div>
                                          </div>
                                        </div>
                               
                                        @endforeach
                                        <!-- End Product Default Single Item -->
                                       
                                       
                                    </div>
                                 
                                </div>
                  
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div> 
          {{--end section   --}}
                                                                      
                                                                  




                    
    </form>

    <script>
        $(document).ready(function() {
         var mainImageSrc = $('#images_main').attr('src');
         var thumbnailImages = $('.thumbnail-image');

         thumbnailImages.click(function() {
             var clickedImageSrc = $(this).attr('src');
             $(this).attr('src', mainImageSrc);
             $('#main-image').attr('src', clickedImageSrc);
             mainImageSrc = clickedImageSrc;
         });

         $('.reply-btn').click(function(event) {
             event.preventDefault();
             var commentId = $(this).data('comment-id');
             var commentReply = $('#comment-reply-' + commentId);

             // Hiển thị hoặc ẩn phần comment của admin
             commentReply.toggle();
         });
     });
     </script>

@endsection
