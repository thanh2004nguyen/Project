@extends('layouts.app')
@section('title','Check-Out Page')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

$(document).ready(function() {
  // Event listener for the address option select element
  $('input[name="address_option"]').on('change', function() {
    var selectedOption = $(this).val();
    var provinceSelect = $('#provinceSelect');
    var districtSelect = $('#districtSelect');
    var wardSelect = $('#wardSelect');

    if (selectedOption === 'reuse') {
      // Hide the new address section
      $('#newAddressSection1 input').prop('disabled', true);
      provinceSelect.prop('disabled', true).removeAttr('required');
      districtSelect.prop('disabled', true).removeAttr('required');
      wardSelect.prop('disabled', true).removeAttr('required');
      $('#newAddressSection1').hide();
      // Show the existing address section
      $('#existingAddressSection').show();
    } else if (selectedOption === 'new') {
      // Hide the existing address section
      $('#existingAddressSection').hide();
      $('#newAddressSection1').show();
      $('#newAddressSection1 input').prop('disabled', false);
      provinceSelect.prop('disabled', false).prop('required', true)
      districtSelect.prop('disabled', false).prop('required', true)
      wardSelect.prop('disabled', false).prop('required', true)
    }
  });
})
</script>


<script>

    $(document).ready(function() {
      $('#myForm').submit(function(event) {
        // event.preventDefault(); // Prevent the default form submission
        var action = $('button[type="submit"][clicked="true"]').val();
        if (action === 'confirm') {
          $('#myForm').attr('action', '{{URL::to('checkout/confirm')}}');
        } else if (action === 'vnpayment') {
          $('#myForm').attr('action', '{{URL::to('/vnpay_payment')}}');
        }else if (action === 'confirmpaypal') {
          $('#myForm').attr('action', '{{URL::to('/paypal_payment')}}');
        }
        // this.submit(); // Submit the form with the updated action URL
      });
      $('button[type="submit"]').click(function() {
        $('button[type="submit"]').removeAttr('clicked');
        $(this).attr('clicked', 'true');
      });
    });

  </script>
<script>
    // voucher
$(document).ready(function() {
    $('#voucherCode').blur(function(event) {
        var voucherCode = $(this).val();
        var shippingFee = parseFloat($('#shippingFee').val());
        var FreeShip = - shippingFee;
        var total = parseFloat($('#total').text()) ; 
        var selectedShippingOption = $('input[name="shipping"]:checked').val();
            $.ajax({
                url: '{{ route("check.voucher") }}',
                type: 'GET',
                data: {voucherCode: voucherCode},
                success: function(response) {
             if (response.valid)
               {
                 if(response.expired)
                 {
                     // Coupon code is valid but expired
                     $('#couponMessage').html('<div class="new-red-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-xmark"></i></div><div class="new-message col-sm-10">Coupon code is valid but expired.</div><div class="new-xmark col-sm-1"></div></div></div>').show();

                 }
                 else if(response.used)
                 {
                     $('#couponMessage').html('<div class="new-red-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-xmark"></i></div><div class="new-message col-sm-10">Coupon code is valid but used.</div><div class="new-xmark col-sm-1"></div></div></div>').show();
                 }else if(response.notown)
                 {

                     $('#couponMessage').html('<div class="new-red-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-xmark"></i></div><div class="new-message col-sm-10">You not own this Voucher</div><div class="new-xmark col-sm-1"></div></div></div>').show();
                 }
                 else
                 {
                      // Coupon code is valid and not expired
                      $('#couponMessage').html('<div class="new-green-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-check"></i></div><div class="new-message col-sm-10">Coupon code is valid and applied successfully.</div><div class="new-xmark col-sm-1"></div></div>').show();
                     // Perform any additional actions (e.g., update order total)
                      var discountValue = response.discount;

                      if (response.discountType === 'amount') {
                         // Voucher with a fixed amount discount
                         discountValue = -discountValue;
                         } else if (response.discountType === 'percent') {
                         // Voucher with a percentage discount
                         discountValue = -(total * (discountValue / 100));
                         }
                         
                     $('#discountValue').text(discountValue);

                     if (selectedShippingOption === 'Free_Ship')
                     {    
                         var subtotal =shippingFee + total+FreeShip +discountValue;
                         $('#totalValue').text(subtotal);
                         if(subtotal<0)
                         {
                             $('#totalValue').text(0);
                         }
                     }

                     if (selectedShippingOption === 'High_Speed_delivery')
                     {    
                         var subtotal =shippingFee + total +discountValue;
                         $('#totalValue').text(subtotal);
                         if(subtotal<0)
                         {
                             $('#totalValue').text(0);
                         }
                     }


                 }     
               }
             
             else
                {
                 // Coupon code is invalid
                 $('#couponMessage').html('<div class="new-red-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-xmark"></i></div><div class="new-message col-sm-10">Invalid coupon code.</div><div class="new-xmark col-sm-1"></div></div>').show();
                 $('#discountValue').text(0);
                 if (selectedShippingOption === 'Free_Ship')
                     {    
                         var subtotal =shippingFee + total+FreeShip;
                         $('#totalValue').text(subtotal);
                         if(subtotal<0)
                         {
                             $('#totalValue').text(0);
                         }
                     }

                     if (selectedShippingOption === 'High_Speed_delivery')
                     {    
                         var subtotal =shippingFee + total;
                         $('#totalValue').text(subtotal);
                         if(subtotal<0)
                         {
                             $('#totalValue').text(0);
                         }
                     }
             }
         },
         error: function() {
             // Error handling
             $('#couponMessage').html('<div class="new-red-alert"><div class="row px-0"><div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-xmark"></i></div><div class="new-message col-sm-10">Error occurred while checking the coupon code.</div><div class="new-xmark col-sm-1"></div></div>').show();
         }
     });
 });
});
</script>

<script>

paypal.Button.render({
         
         // Configure environment
         env: 'sandbox',
         client: {
         sandbox: 'AR0-W4Erl8qG5RQLDy4y3PUxpzCAj2gTdpJLKb2EEC5LBmXYITh0vzavQvxxRLSYWKZpYDzY05uaOE7Q',
         production: 'demo_production_client_id'
         },
         // Customize button (optional)
         locale: 'en_US',
         style: {
         size: 'small',
         color: 'gold',
         shape: 'pill',
         },
     
         // Enable Pay Now checkout flow (optional)
         commit: true,
     
         // Set up a payment
         payment: function(data, actions) {
     
           if (!validateForm()) {
             // Show an error message
             alert('Please fill in all required fields before proceeding with the payment.');
             return false; // Prevent the payment creation
           }
             // lấy total price để thanh toán paypal
             var shippingFee = $('#shippingFee').val();
             const total1 = document.getElementById("totalValue");
             const total = total1.textContent;
           
             
             var usd = (parseFloat(total)) / 1;
         
       //   var usd = document.getElementById("vn_to_usd").value;    
         return actions.payment.create({
             transactions: [{
             amount: {
               total: usd.toFixed(2),
                 currency: 'USD'
             }
             }]
         });
         },
     
         // Execute the payment
         onAuthorize: function(data, actions) {
         return actions.payment.execute().then(function() {
             // Show a confirmation message to the buyer
             window.alert('Thank you for your purchase!');
           //   auto confirm order after finish payment
           document.getElementById("confirm-button").click();// Auto-submit the form
         });
       }       
     }, '#paypal-button');
     
     
     
     function validateForm() {
       // Perform your form validation checks here
       // Return true if the form is valid, false otherwise
       var isFormValid = true;
       
       // Example validation check for a radio button
       if (!$('input[name="shipping"]').is(':checked')) {
         isFormValid = false;
       }
       
       return isFormValid;
     }
     


</script>



@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @php
                $errorMessages = $errors->all();
            @endphp
            <li>{!! implode('</li><li>', $errorMessages) !!}</li>
        </ul>
    </div>
@endif
<form id="myForm"  method="POST">
    @csrf
   
<div class="page-first-row">
    <div class="page-title">
        Quick Checkout
        <hr>
    </div>
</div>
<section class="checkout-body">
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="left col-sm-11">
                        <!-- !Deliver -->
                        <div class="basic-container">
                            <div class="basic-title">
                                Deliver to
                                <hr>
                            </div>



                            @if($user->shipping_wardId)
                            <div style="text-align: left;">
                                <input   type="radio" name="address_option" value="reuse" checked><span style="color: rgb(209, 127, 20)">USING EXISTING ADDRESS</span>  <br>
                                <input type="radio" name="address_option" value="new"><span style="color: rgb(209, 127, 20)">ADD NEW ADDRESS </span> 
                               </div>
                            <div id="existingAddressSection" style="display: none;">
                              <!-- Display the existing address details here -->
                              <td class="deliver-address">
                                <div class="name-phone">{{ $user->name}} {{ $user->phone}}  </div>
                                <div class="address-detail">{{ $user->address}}</div>
                                <div class="email">{{ $user->email}}</div>
                                <input type="hidden" id="getdicttrictId" name="getdicttrictId" value="{{ $user->shipping_dictrictId }}">
                                <input type="hidden" id="getwardId" name="getwardId" value="{{ $user->shipping_wardId }}">
                            </td>
                            </div>
                            <div id="newAddressSection1" style="display: none;">
                                <!-- Display the form fields for adding a new address here -->
                                <form name="addForm" id="add-address-form" >
                                  <table class="add-address-section" style="text-align: left;">
                                      <tr>
                                          <td>
                                              <div style="color: rgb(209, 127, 20)" class="add-address-title">Name <span style="color: red;" >*</span></div>
                                              <div><input type="text" class="form-control" name="name" required  value="{{$user->name}}"></div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div style="color: rgb(209, 127, 20)" class="add-address-title">Telephone <span style="color: red;">*</span></div>
                                              <div><input type="text" class="form-control" name="phone" required value="{{$user->phone}}" ></div>
  
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div style="color: rgb(209, 127, 20)" class="add-address-title">Email <span style="color: red;">*</span></div>
                                              <div><input type="text" class="form-control" name="email" id="email" required value="{{$user->email}}" ></div>
                                          </td>
                                      </tr>
  
                                      <tr>
                                          <td>
                                              <div style="background-color: rgb(223, 135, 20)" class="add-address-title">SHIPPING ADDRESS <span style="color: red;">*</span></div>
                                          </td>
                                      </tr>
  
                                              <tr>
                                                  <td style="color: rgb(209, 127, 20)">Street/Apartment
                                                      <input type="text" id="street" name="street" required value="{{ $user->shipping_address_street}} ">
                                                  </td>
                                         
                                              </tr>
  
                                                  <tr>
                                                      <td style="color: rgb(209, 127, 20)">Province/City<span style="color: red;">*</span>
                                                          <select id="provinceSelect" name="province"  required >
                                                              <option value=""  selected >Select Province</option>
                                                          </select></td>
                                                  </tr>
                                             
                                        
                                      </tr>
                                          <td style="color: rgb(209, 127, 20)">District<span style="color: red;">*</span>
                                              <select id="districtSelect" name="district" required >
                                                  <option value="" >Select District</option>
                                              </select></td>
                                     
                                      </tr>
                                      <tr>
                                          <td style="color: rgb(209, 127, 20)">Ward<span style="color: red;">*</span>
                                              <select id="wardSelect" name="ward" required  >
                                                  <option value="">Select Ward</option>
                                              </select></td>
                                          <td>
                                          </tr>
                                  </table>
                              </form>
                          </div>
                            @elseif(!$shipping)
                       <h3>Please Complete Shipping Address Form</h3> 
                            <div id="newAddressSection" >
                                <!-- Display the form fields for adding a new address here -->
                                <form name="addForm" id="add-address-form" >
                                    <table class="add-address-section" style="text-align: left;">
                                        <tr>
                                            <td>
                                                <div style="color: rgb(209, 127, 20)" class="add-address-title">Name <span style="color: red;" >*</span></div>
                                                <div><input type="text" class="form-control" name="name" required  value="{{$user->name}}"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="color: rgb(209, 127, 20)" class="add-address-title">Telephone <span style="color: red;">*</span></div>
                                                <div><input type="text" class="form-control" name="phone" required value="{{$user->phone}}" ></div>
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="color: rgb(209, 127, 20)" class="add-address-title">Email <span style="color: red;">*</span></div>
                                                <div><input type="text" class="form-control" name="email" id="email" required value="{{$user->email}}" ></div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td>
                                                <div style="background-color: rgb(223, 135, 20)" class="add-address-title">SHIPPING ADDRESS <span style="color: red;">*</span></div>
                                            </td>
                                        </tr>
    
                                                <tr>
                                                    <td style="color: rgb(209, 127, 20)">Street/Apartment
                                                        <input type="text" id="street" name="street" required value="{{ $user->shipping_address_street}} ">
                                                    </td>
                                           
                                                </tr>
    
                                                    <tr>
                                                        <td style="color: rgb(209, 127, 20)">Province/City<span style="color: red;">*</span>
                                                            <select id="provinceSelect" name="province"  required >
                                                                <option value=""  selected >Select Province</option>
                                                            </select></td>
                                                    </tr>
                                               
                                          
                                        </tr>
                                            <td style="color: rgb(209, 127, 20)">District<span style="color: red;">*</span>
                                                <select id="districtSelect" name="district" required >
                                                    <option value="" >Select District</option>
                                                </select></td>
                                       
                                        </tr>
                                        <tr>
                                            <td style="color: rgb(209, 127, 20)">Ward<span style="color: red;">*</span>
                                                <select id="wardSelect" name="ward" required  >
                                                    <option value="">Select Ward</option>
                                                </select></td>
                                            <td>
                                            </tr>
                                    </table>
                                </form>
                            </div>

                         
                              @else
                             <div style="text-align: left;">
                            <input   type="radio" name="address_option" value="reuse" checked><span style="color: rgb(209, 127, 20)">USING EXISTING ADDRESS</span>  <br>
                            <input type="radio" name="address_option" value="new"><span style="color: rgb(209, 127, 20)">ADD NEW ADDRESS </span> 
                           </div>
                            <div id="existingAddressSection" style="display: none;">
                              <!-- Display the existing address details here -->
                              <td class="deliver-address">
                                <div class="name-phone">{{ $shipping->shipping_name }} ||{{ $shipping->shipping_phone }}  </div>
                                <div class="address-detail">{{ $shipping->shipping_address}}</div>
                                <input type="hidden" id="getdicttrictId" name="getdicttrictId" value="{{ $shipping->shipping_dictrictId }}">
                                <input type="hidden" id="getwardId" name="getwardId" value="{{ $shipping->shipping_wardId }}">
                            </td>
                            </div>


                            <div id="newAddressSection1" style="display: none;">
                              <!-- Display the form fields for adding a new address here -->
                              <form name="addForm" id="add-address-form" >
                                <table class="add-address-section" style="text-align: left;">
                                    <tr>
                                        <td>
                                            <div style="color: rgb(209, 127, 20)" class="add-address-title">Name <span style="color: red;" >*</span></div>
                                            <div><input type="text" class="form-control" name="name" required  value="{{$shipping->shipping_name}}"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="color: rgb(209, 127, 20)" class="add-address-title">Telephone <span style="color: red;">*</span></div>
                                            <div><input type="text" class="form-control" name="phone" required value="{{$shipping->shipping_phone}}" ></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="color: rgb(209, 127, 20)" class="add-address-title">Email <span style="color: red;">*</span></div>
                                            <div><input type="text" class="form-control" name="email" id="email" required value="{{$shipping->shipping_email}}" ></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div style="background-color: rgb(223, 135, 20)" class="add-address-title">SHIPPING ADDRESS <span style="color: red;">*</span></div>
                                        </td>
                                    </tr>

                                            <tr>
                                                <td style="color: rgb(209, 127, 20)">Street/Apartment
                                                    <input type="text" id="street" name="street" required value="{{ $shipping->shipping_address_street}} ">
                                                </td>
                                       
                                            </tr>

                                                <tr>
                                                    <td style="color: rgb(209, 127, 20)">Province/City<span style="color: red;">*</span>
                                                        <select id="provinceSelect" name="province"  required  value="{{ $shipping->shipping_dictrictId}} ">
                                                            <option value="{{ $shipping->shipping_dictrictId}}"  selected >Select Province</option>
                                                        </select></td>
                                                </tr>
                                           
                                      
                                    </tr>
                                        <td style="color: rgb(209, 127, 20)">District<span style="color: red;">*</span>
                                            <select id="districtSelect" name="district" required >
                                                <option value="{{ $shipping->shipping_dictrictId}}" >Select District</option>
                                            </select></td>
                                   
                                    </tr>
                                    <tr>
                                        <td style="color: rgb(209, 127, 20)">Ward<span style="color: red;">*</span>
                                            <select id="wardSelect" name="ward" required value="{{ $shipping->shipping_dictrictId}} " >
                                                <option value="">Select Ward</option>
                                            </select></td>
                                        <td>
                                        </tr>
                                </table>
                            </form>
                        </div>
                            @endif
                          



                            <div class="add-address-container">
                            </div>
                        </div>
          
                        <!-- !Order -->
                        <div class="basic-container mt-5">
                            <div class="basic-title">
                                <div id="order-title">
                                    <div>
                                        Order
                                        <div id="item-num"></div>
                                    </div>
                                    <a href="{{URL::to('/cart')}}"><div class="show-text" style="padding-top: 0;">Change</div></a>
                                </div>
                                <hr>
                            </div>
                            @foreach($items as $item)
                            <table id="order-table">
                                <tr ng-repeat="cart in carts">
                                    <td><img src="{{$item->product->images->first()->url}}"  alt="seed1" class="order-table-img"></td>
                                    <td class="order-table-product"> {{ $item->product->name}}</td>
                                    <td class="order-table-quantity">{{ $item->quantity}}</td>
                                    <td  class="order-table-price">{{ $item->total()}}</td>
                                </tr>
                            </table>
                            @endforeach
                            <hr>
                            <table id="order-total-table">
                                <tr>
                                    <td  class="order-total-table-title">Sub-Total: </td>
                                    <td id="total" class="order-total-table-content">{{$total}}</td>
                                  
                                </tr>
                                <tr>
                                    <td class="order-total-table-title">Shipping: </td>
                                    <td name="shippingFeeValue"  id="shippingFeeValue" class="order-total-table-content" > </td>
                                </tr>
                                <tr>
                                    <td class="order-total-table-title">FREE Shipping: </td>
                                    <td style="color: rgb(233, 195, 138)" name="Freeshipping"  id="Freeshipping" class="order-total-table-content" > </td>
                                </tr>

                                <tr>
                                    <td class="order-total-table-title">Discount: </td>
                                    <td style="color: rgb(233, 195, 138)" name="discountInput"  id="discountValue" class="order-total-table-content"  >0</td>
                                </tr>


                                <tr >
                                    <td class="order-total-table-title">Total: </td>
                                    <td style="color: red" id="totalValue" class="order-total-table-content" ></td>
                                </tr>
                                        
                            </table>
                            
                        </div>
                
                    </div>
                </div>
            </div>



            <div class="col-sm-8">   <!-- !Coupon -->
                <div class="basic-container row mt-5">
                    <div class="basic-title">
                        Coupon/Voucher
                        <hr>
                    </div>

                    <div class="col-sm-5" id="coupon-enter">Enter your coupon here</div>
                    <div class="col-sm-5"><input type="text" id="voucherCode" name="voucherCode"  ></div>
                    {{-- <div class="col-sm-2 mb-3"><input type="submit" form="coupon-form" value="Submit" class="coupon-btn"></div> --}}
                    <div  id="couponMessage" name="couponMessage" >
                    </div>
                
                </div>
                <!-- !Shipping-Payment Method -->
                <div class="basic-container row">
                    <div class="col-sm-12 px-0">
                        <div class="basic-title">
                            Shipping Method
                            <hr>
                        </div>
                        <table id="method-table">
                            <tr>
                                <td class="radio-col"><input type="radio" id="checkout-ship1" name="shipping"value="Free_Ship"></td>
                                <td class="deliver-address"><img width="70px" src="fontend/Image/free.png" alt=""> Free Shipping 0 VND</td>
                                <td class="radio-col"><input type="radio" id="checkout-ship2" name="shipping"  value="High_Speed_delivery"></td>
                                <td class="deliver-address"><img width="100px" src="fontend/Image/fast.jpg" alt="">High Speed Delivery (in 48 hours)</td>
            
                            </tr>
                    
                        </table>
                    </div>
                </div>

                <!-- !Confirm Order -->
                <div class="basic-container row mt-5">
                    <div class="basic-title">
                        Confirm Your Order
                        <hr>
                    </div>
                    <label for="deliver-note" id="deliver-note-title">Deliver Note</label>
                    <textarea name="deliver-note" id="deliver-note" cols="5" rows="5"></textarea>
                    <div id="disclaimer-message">
                        <input type="checkbox"  id="disclaimerCheck">
                        I completely agree to TREE ONE <span style="text-decoration: underline; color:#0879E1; cursor: pointer;" ng-click="popDisclaimer()">Delivery Disclaimer</span>.
                    </div>

                    <div class="new-yellow-alert" ng-show="disclaimerAlert">
                        <div class="row px-0">
                            <div class="new-tick-cross col-sm-1"><i class="fa-solid fa-circle-exclamation"></i></div>
                            <div class="new-message col-sm-10">Please agree to our Delivery Disclaimer</div>
                            <div class="new-xmark col-sm-1"><i class="fa-solid fa-xmark" ng-click="disclaimerAlert = false"></i></div>
                        </div>
                    </div>
                            {{-- get province- dictrict- warld name --}}
                            <input type="hidden" name="provinceName" id="provinceNameInput">
                            <input type="hidden" name="dictrictName" id="dictrictNameInput">
                            <input type="hidden" name="warldName" id="warldNameInput">
                            <input type="hidden" id="shippingFee" name="shippingFee" value="">
                            <input type="hidden" id="getsubtotal" name="getsubtotal" value="">
                      
                 

                               {{-- get province- dictrict- warld name --}}
                           
        

                       <div class="payment-col col-sm-12">
                        <div class="basic-title">
                                 PAYMENT METHOD
                            <hr>
                        </div>
                        <table id="method-table">
                        <tr>
                            
                            <td>
                              {{-- button thanh toan paypal --}}
                          
                              <div class="col-md-13">
                                @php
                                $vn_to_usd = ($total);
                                @endphp
                                <div id="paypal-button"></div>
                                <input type="hidden" id="vn_to_usd"  value="{{ round($vn_to_usd,2)}}">
                               </div>
                                 <button style="display: none" class="get-quote-btn" type="submit" value="confirmpaypal" name="action" 
                               id="confirm-button"></button>
                            </td>
                            <td>
                                {{-- button thanh toan vnpay --}}
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-default check_out" name="redirect" value="vnpayment"   >
                                    <span class="button-icon"><img width="120px" src="fontend/Image/vnpay.jpg"alt=""></span></button>
                                      <input type="hidden" name="total_vnpay" id="total_vnpay"  >
                              </div>
                            </td>
                                  <td>
                                      <br>
                                        <button   class="btn btn-success" type="submit" value="confirm" name="action" >
                                            Pay On Delivery
                                        </button>   
                                  </td>
                        </tr>
                        </table>
                       </div>          
                 </form>      
                              
                </div>
            </div>
        </div>
    </div>
</section>
</form>
<script src="{{ asset('fontend/JS/freeship.js') }}"></script>
<script src="{{ asset('fontend/JS/voucher.js') }}"></script>

@endsection