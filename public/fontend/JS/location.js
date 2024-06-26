
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
                    selectBox.append('<option value="' + province.ProvinceID + '">' + province.ProvinceName + '</option>');
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
                            districtSelectBox.append('<option value="' + district.DistrictID + '">' + district.DistrictName + '</option>');
                         
                        });

                        selectBox.on('change', function() {
                            var selectedDctrictName = $(this).find('option:selected').text();
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
                    wardSelectBox.append('<option value="' + ward.WardCode + '">' + ward.WardName + '</option>');
                });

                
                selectBox.on('change', function() {
                    var selectedwarldName = $(this).find('option:selected').text();
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
                var shippingFee = (response.data.total);
                var shippingFee1 = parseFloat(Math.floor(((shippingFee)/23000)*100)/100);
                var total = parseFloat($('#total').text())  ; 
                var subtotal =shippingFee1 + total;
                // Display the shipping fee in the result container
                $('#shippingFeeValue').text(shippingFee1);
                $('#totalValue').text(parseFloat(subtotal).toFixed(2));
                $('#resultContainer').text('Shipping Fee: ' + shippingFee1);
    
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
                    var shippingFee = response.data.total;
                    var shippingFee1 = parseFloat(Math.floor(((shippingFee)/23000)*100)/100);
                    var total = parseFloat($('#total').text())  ; 
                    var subtotal =shippingFee1 + total;
                    // Display the shipping fee in the result container
                    $('#shippingFeeValue').text(shippingFee1);
                    // $('#totalValue').text(subtotal);
                    $('#shippingFee').val(shippingFee1);
                    $('#getsubtotal').val(total);
                    $('#total_vnpay').val(subtotal);

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });

   




