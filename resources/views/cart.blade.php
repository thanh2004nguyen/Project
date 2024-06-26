@extends('layout.layout')
@section('title','Product List')
@section('content')

<script>
    // Validate quantity before submitting the form
    $(document).ready(function() {
      $('#checkout').submit(function(e) {
        var quantity = parseInt($('.cart-quantity').val());
        if (quantity > 100) {
          e.preventDefault();
          alert('Quantity cannot exceed 100.');
        }
      });
    });
  </script>

<link rel="stylesheet" href="fontend/CSS/cart.css">
<div class="address-container">
    <a href="#/"><i class="fa-solid fa-house"></i></a>
    <div class="address">
        <a href="#/"> Home </a>/
        <a href="#!cart"> Shopping Cart </a>
    </div>
</div>
<!-- !Page First Row -->
<div class="page-first-row">
    <div class="page-title">
        Shopping Cart
        <hr>
    </div>
</div>

<section class="cart-body">
  
    <!-- !Cart table -->
    @if($total==0)
    <h2 style="text-align: center; color:rgb(233, 22, 127)" >There Are No Item On Your Cart</h2>
    @else
    
    <div class="container my-4">
        <table id="cart-table" width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Product Name</td>
                    <td>Unit Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $item)
                <tr>
                    <td><img src="{{ 'img/' . $item->product->image->first()->url}}" 
                        alt="{{ 'fontend/Image/' . $item->product->name}}"  height="100%"></td>
                    <td><div> {{ $item->product->name}}</div></td>
                    <td><div> {{ $item->price}}</div></td>
                    <td>
                        <div class="cart-action">
                            <!-- <div class="row"> -->
                                
                                <form action="{{ route('cart.update',['product_id' => $item->product_id]) }}" method="post">
                                    @csrf
                                    <div>
                                        <button type="submit" class="btn btn-success cart-update-button" >Update</button>
                                    </div>
                                <div>
                                    <input type="number" class="cart-quantity" value="{{ $item->quantity}}" min="1" max="100" name="quantity">
                                </div>
                                </form>

                                <form action="{{ route('cart.delete', ['product' => $item->product]) }}" method="get">
                                    @csrf
                                <div>
                                    <button type="submit" class="btn btn-danger cart-delete-button" ><i class="fa-solid fa-trash"></i></button>
                                </div>
                                </form>


                             <!-- </div> -->
                        </div>
                    </td>
                    <td>{{ $item->total()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 
    <div class="container mb-4">
        <div class="row">
            <!-- !What would you like to do next? -->
            <div class="col-sm-8">
                <div class="basic-container">
                    <div class="basic-title">
                        What would you like to do next?
                        <hr>
                    </div>
                   

                    <hr class="grey-hr">

                    <div class="do-next-section">
                        <div class="do-next">
                            <div class="do-next-first-row" ng-click="showShipEstimate = !showShipEstimate">
                                <div class="do-next-title">Estimate Shipping fee</div>
                        
                            </div>
                        </div>
                        <div id="ship-estimate" ng-show="showShipEstimate">
                            <div class="container">
                                <div>Select your destination to get a shipping estimate</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table id="city-select">
                                            <tr>
                                                <td>Tỉnh/ThànhPhố<span style="color: red;">*</span></td>
                                                <td>
                                                    <select id="provinceSelect" name="province">
                                                        <option value="">Select Province</option>
                                                    </select>
    
                                                </td>
                                                <td>Quận/Huyện<span style="color: red;">*</span></td>
                                                <td>
                                                    <select id="districtSelect" name="district">
                                                        <option value="">Select District</option>
                                                    </select>
                                                </td>

                                                <td>Phường/Xã<span style="color: red;">*</span></td>
                                                <td>
                                                    <select id="wardSelect" name="ward">
                                                        <option value="">Select Ward</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- check shipping fee button --}}
                            <div class="get-quote-area">
                                <button class="get-quote-btn" id="calculateButton">Check</button> 
                                <div id="resultContainer"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- !Total-Bill table -->
            <div class="col-sm-4">
                <div class="basic-container">
                    <table id="cart-total-table">
                        <tr>
                            <td>Sub-Total:</td>
                           <td id="total">{{$total}}</td>
                        </tr>
                        <tr>
                            <td>  Shipping:</td>
                           <td id="shippingFeeValue"></td>
    
                        </tr>
                        <tr>
                            <td>  Total:</td>
                            <td id="totalValue"></td>
                            
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <form id="checkout" action="{{ URL::to('/checkout') }}" method="get">
    <div class="container">
        <div class="continue-check-area">
            <button class="continue-btn">
                <a href="{{URL ('/home')}}">
                    Continue Shopping
                </a>
            </button>

        
            @if($total!=0)
 
            <button class="get-quote-btn"  >
                <a s class="btn btn-primary" >CheckOut</a>
            </button>
         </form>
            @endif
        </div>
    </div>
</section>
@endsection

