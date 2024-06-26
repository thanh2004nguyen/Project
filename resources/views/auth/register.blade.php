<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // Validate name
    $(document).ready(function() {
        $('#name').blur(function(event) {
            var name = $(this).val();
       
            //  check name is required
            if (!name) {
                $('#name-error').html('Name required');
                $("#name-error").css("color", "red");
               
    
                //  check do dai cua name>3
            }else if(name.length < 3)
               {
                $('#name-error').html('Name must be at least 3 characters long.');
                $("#name-error").css("color", "red");   
               }
    
            else {
              $("#name-error").html("You can use this Name");
              $("#name-error").css("color", "blue");
            }
        });
    });
    
    
     // Validate email format
    $(document).ready(function() {
        $('#email').blur(function(event) {
            var email = $(this).val();
           
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $('#email-error').html('Email is required Or Invalid email format.');
                $("#email-error").css("color", "red");
            }
            // Validate if email is already taken
            else {
                $.ajax({
                    url: '{{ route("check-email") }}',
                    type: 'GET',
                    data: {email: email},
                    success: function(response) {
    
                        if (response.exists) 
                        {
                            $('#email-error').html('This email is already taken.');
                            $("#email-error").css("color", "red");
                        }
                            else 
                            {
                            $('#email-error').html('You can use this email.');
                            $("#email-error").css("color", "blue");
                            }
                    },
                });
            }
        });
    
    
    
        // Validate password
    $(document).ready(function() {
        $('#password').blur(function(event) {
            var password = $(this).val();
    
            //  check name is required
                //  check do dai cua name>3
            if(!password || password.length < 8 || !hasNumber(password))
               {
                $('#password-error').html('Password must be at least 8 characters long and at least one number');
                $("#password-error").css("color", "red");   
               }
    
            else {
              $("#password-error").html("You can use this Password");
              $("#password-error").css("color", "blue");
            }
        });
    });
    function hasNumber(str) {
      return /\d/.test(str);
    }
    
    $(document).ready(function() {
        $('#password_confirmation').blur(function(event) {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            if (password != confirmPassword) {
                $('#confirm-password-error').html('Passwords do not match.');
                $("#confirm-password-error").css("color", "red");
            } else {
                $('#confirm-password-error').html('');
            }
        });
    });
       
    
    });
    
    </script>
<x-guest-layout>

    @if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div style="max-height:80vh;" class="overflow-y-scroll">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div id="email-error"></div> 
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <div id="password-error"></div> 
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <div id="confirm-password-error"></div> 
            </div>

            {{-- more  --}}
            <span
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 title-more-info cursor-pointer">
                {{ __('More information') }}
            </span>
            <div id="more-info" style="display: none">
                <div class="mt-4">
                    <x-input-label for="date" :value="__('Date of birthday')" />

                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" />

                    {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
                </div>

                <div>
                    <x-input-label for="street" :value="__('Street/Apartment')" />
                    {{-- <input type="text" id="street" name="street"> --}}
                    <x-text-input type="text" id="street" name="street" class="block mt-1 w-full" />
                </div>
                <div class="flex flex-row w-full flex-wrap">
                    <div class="mx-1">
                        <x-input-label for="provinceSelect" :value="__('Province/City')" />
                        <select id="provinceSelect" name="province"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select Province</option>
                        </select>

                    </div>
                    <div class="mx-1">

                        <x-input-label for="districtSelect" :value="__('Dictrict')" />
                        <select id="districtSelect" name="district"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select District</option>
                        </select>

                    </div>
                    <div class="mx-1">
                        <x-input-label for="wardSelect" :value="__('Wards')" />
                        <select id="wardSelect" name="ward"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select Ward</option>
                        </select>
                    </div>
                </div>
                {{--  --}}
                {{--  --}}
                <input type="hidden" name="provinceName" id="provinceNameInput">
                <input type="hidden" name="dictrictName" id="dictrictNameInput">
                <input type="hidden" name="warldName" id="warldNameInput">
                {{--  --}}
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
<script>
    $(document).ready(function() {
        // Retrieve provinces from the API
        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
            type: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Token': '5ccee01a-f308-11ed-a967-deea53ba3605'
            },
            success: function(response) {
                console.log(response);
                var provinces = response.data;
                var selectBox = $('#provinceSelect');

                var filteredProvinces = provinces.filter(function(province) {
                    return province.ProvinceID === 202;
                });


                // Populate the select box with provinces
                $.each(filteredProvinces, function(index, province) {
                    selectBox.append('<option value="' + province.ProvinceID + '">' +
                        province.ProvinceName + '</option>');
                });

                selectBox.on('change', function() {
                    var selectedProvinceName = $(this).find('option:selected').text();
                    $('#provinceNameInput').val(selectedProvinceName);
                });
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });

        // Handle province selection change
        $('#provinceSelect').on('change', function() {
            var provinceId = $(this).val();
            var districtSelectBox = $('#districtSelect');

            // Clear the previous options in the district select box
            districtSelectBox.empty();

            if (provinceId) {
                // Retrieve districts for the selected province
                $.ajax({
                    url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                    type: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Token': '5ccee01a-f308-11ed-a967-deea53ba3605'
                    },
                    data: {
                        'province_id': provinceId
                    },
                    success: function(response) {
                        console.log(response);
                        var districts = response.data;
                        var selectBox = $('#districtSelect');
                        // Populate the district select box with districts
                        $.each(districts, function(index, district) {
                            districtSelectBox.append('<option value="' + district
                                .DistrictID + '">' + district.DistrictName +
                                '</option>');

                        });

                        selectBox.on('change', function() {
                            var selectedDctrictName = $(this).find(
                                'option:selected').text();
                            $('#dictrictNameInput').val(selectedDctrictName);
                        });


                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            }
        });

        $('#districtSelect').on('change', function() {
            var districtId = $(this).val();
            var wardSelectBox = $('#wardSelect');

            // Clear the previous options in the ward select box
            wardSelectBox.empty();

            if (districtId) {
                // Retrieve wards for the selected district
                $.ajax({
                    url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                    type: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Token': '5ccee01a-f308-11ed-a967-deea53ba3605'
                    },
                    data: {
                        'district_id': districtId
                    },
                    success: function(response) {
                        var selectBox = $('#wardSelect');
                        var wards = response.data;
                        console.log(response);
                        // Populate the ward select box with wards
                        $.each(wards, function(index, ward) {
                            wardSelectBox.append('<option value="' + ward.WardCode +
                                '">' + ward.WardName + '</option>');
                        });


                        selectBox.on('change', function() {
                            var selectedwarldName = $(this).find('option:selected')
                                .text();
                            $('#warldNameInput').val(selectedwarldName);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            }
        });
    });

    //  Cart check fee shipping
    $('#calculateButton').on('click', function() {
        var weight = 200; // Weight in grams
        var height = 50; // Height in centimeters
        var length = 20; // Length in centimeters
        var width = 20; // Width in centimeters
        var toDistrictId = parseInt($('#districtSelect').val());
        var toWardCode = $('#wardSelect').val();
        var total = parseInt($('#total').val());
        var serviceId = 53320; // ID of the selected service
        var requestData = {
            from_district_id: 1454, // ID of the sender's district
            from_ward_code: "21211", // Code of the sender's ward
            service_id: serviceId,
            to_district_id: toDistrictId,
            to_ward_code: toWardCode,
            height: height,
            length: length,
            weight: weight,
            width: width,
            insurance_value: 10000, // Optional: Insurance value
            cod_failed_amount: 2000, // Optional: COD failed amount
            coupon: null // Optional: Coupon code
        };
        console.log(requestData);

        // Make the API call to calculate the shipping fee
        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Token': '5ccee01a-f308-11ed-a967-deea53ba3605',
                'ShopId': '4137662'
            },
            data: JSON.stringify(requestData),
            success: function(response) {
                var shippingFee = response.data.total;
                var total = parseFloat($('#total').text());
                var subtotal = shippingFee + total;
                // Display the shipping fee in the result container
                $('#shippingFeeValue').text(shippingFee);
                $('#totalValue').text(subtotal);
                $('#resultContainer').text('Shipping Fee: ' + shippingFee);

            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });


    $('#provinceSelect').on('change', function() {
        // Clear the shipping fee value
        $('#shippingFee').val('');
        $('#shippingFeeValue').text('');
        $('#totalValue').text('');
        $('#Freeshipping').text('');
        $('#checkout-ship1').prop('checked', false);
        $('#checkout-ship2').prop('checked', false);
    });

    //  new address shipping fee
    $('#wardSelect').on('change', function(event) {
        event.preventDefault();
        var weight = 200; // Weight in grams
        var height = 50; // Height in centimeters
        var length = 20; // Length in centimeters
        var width = 20; // Width in centimeters
        var toDistrictId = parseInt($('#districtSelect').val());
        var toWardCode = $('#wardSelect').val();
        var total = parseInt($('#total').val());
        var serviceId = 53320; // ID of the selected service
        var requestData = {
            from_district_id: 1454, // ID of the sender's district
            from_ward_code: "21211", // Code of the sender's ward
            service_id: serviceId,
            to_district_id: toDistrictId,
            to_ward_code: toWardCode,
            height: height,
            length: length,
            weight: weight,
            width: width,
            insurance_value: 10000, // Optional: Insurance value
            cod_failed_amount: 2000, // Optional: COD failed amount
            coupon: null // Optional: Coupon code
        };
        console.log(requestData);

        // Make the API call to calculate the shipping fee
        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Token': '5ccee01a-f308-11ed-a967-deea53ba3605',
                'ShopId': '4137662'
            },
            data: JSON.stringify(requestData),
            success: function(response) {
                var Freeshipping = parseFloat($('#Freeshipping').val());
                // alert(Freeshipping);
                var shippingFee = response.data.total;
                var total = parseFloat($('#total').text());
                var subtotal = shippingFee + total;
                // Display the shipping fee in the result container
                $('#shippingFeeValue').text(shippingFee);
                // $('#totalValue').text(subtotal);
                $('#shippingFee').val(shippingFee);
                $('#getsubtotal').val(total);
                $('#total_vnpay').val(subtotal);

            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });


    $(".title-more-info").on('click', function() {

        $("#more-info").toggle();
    });
</script>
