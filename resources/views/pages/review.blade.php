@extends('layouts.app')
@section('title','Product List')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('fontend/CSS/detail.css')}}">
<link rel="stylesheet" href="{{ asset('fontend/CSS/product.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('fontend/CSS/css_1.css')}}">  --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
  .rating{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 45px;
    padding-right: 45px;
    font-size: 20px;
    color: rgb(255, 191, 0);
}
  .star-icon {
    color: #000; /* Set the default color for the star icons */
  }

  .star-icon.selected {
    color: rgb(112, 9, 238); /* Set the color for the selected star icons */
  }
  .button1{
    width: 100%;
  }
  .button1{
    height: 48px;
    width: 10%;
    margin-left: 47%;
  } */
  .justify-content-center{
    margin: 0 auto;
    width: 80%;
    height: 80%;
  }
  .card-body img{
    width: 90%;
    margin: 0 auto;
  }
      textarea{
    margin: 0 auto;
    width:100%;
    height:100%;
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

<div class="col-lg-12 pt-5 m-auto text-center">
    <h1>Please Rating Our Product </h1>
    <hr class="product-title">
</div>
<div>
    <div id="card-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- show san pham thieu chieu ngang --}}
                <div class="row justify-content-center">
             
                    <div class="col-lg-4">
                      <div class="card border-0 bg-light mb-2" data-product-id="{{ $productreview->product->product_id }}">
                        <div class="card-body">
                          <img  src="{{ asset($productreview->product->images[0]->url) }}" 
                            alt="{{ 'img/' . $productreview->product->images[0]->url}}" >
                            <div class="card-info">
                                {{ $productreview->name }}
                                <div class="price">
                                    {{ $productreview->product_name}} <br> 
                                    {{ $productreview->product_price}} <br>
                                </div>
                                <form action="{{ URL::to('/submit-review') }}" method="POST" class="review-form">
                                    @csrf
                                    <input style="width: 100%;" type="hidden" name="product_id[]" value="{{ $productreview->product->product_id }}">
                                    <div class="form-group">
                                        <label for="rating" required>Rating:</label>
                                    <input type="hidden" name="rating" value="" >
                                        <div class="star-rating">
                                            <div class="rating" >
                                                <i class="fa-regular fa-star star-icon zero-star" data-rating="1"></i>
                                                <i class="fa-regular fa-star star-icon zero-star" data-rating="2"></i>
                                                <i class="fa-regular fa-star star-icon zero-star" data-rating="3"></i>
                                                <i class="fa-regular fa-star star-icon zero-star" data-rating="4"></i>
                                                <i class="fa-regular fa-star star-icon zero-star" data-rating="5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment:</label> <br>
                                        <textarea name="comment" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           
                </div>
            </div>
        </div>
    </div>
    <div class="button1">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>
</form>
</div>

<br>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.star-icon').click(function() {
      var rating = $(this).data('rating');
      var productId = $(this).closest('.card').data('product-id');
      $('input[name="rating"]').val(rating);
      // Update the star icons' appearance based on the selected rating for the specific product
      $('.star-icon[data-product-id="' + productId + '"]').removeClass('selected');
      $(this).prevAll('.star-icon').addBack().addClass('selected');
    });
  });
</script>
@endsection





