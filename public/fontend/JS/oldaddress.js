$(document).ready(function() {
    // Toggle the display of address sections based on the selected option
    $('input[name="address_option"]').change(function() {
      if (this.value === 'reuse') {

        var weight = 200; // Weight in grams
        var height = 50; // Height in centimeters
        var length = 20; // Length in centimeters
        var width = 20; // Width in centimeters
        var toDistrictId = parseInt($('#getdicttrictId').val());
        var toWardCode = $('#getwardId').val();
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
            var shippingFee1 = parseFloat(Math.floor(((response.data.total)/23000)*100)/100);
            var total = parseFloat($('#total').text());
            var subtotal = shippingFee1 + total;
            // Display the shipping fee in the result container
            $('#shippingFeeValue').text(shippingFee1);
            $('#totalValue').text(parseFloat(subtotal).toFixed(2));
            $('#shippingFee').val(shippingFee1);
            $('#getsubtotal').val(total);
            $('#total_vnpay').val(subtotal);
          },
          error: function(xhr, status, error) {
            console.log('Error:', error);
          }
        });
        $('#existingAddressSection').show();
        $('#newAddressSection').hide();
      } else if (this.value === 'new') {
        $('#shippingFee').val('');
        $('#shippingFeeValue').text('');
        $('#totalValue').text('');
        $('#existingAddressSection').hide();
        $('#newAddressSection').show();
      }
    });
  
    // Trigger the change event on the 'reuse' radio button
    $('input[name="address_option"][value="reuse"]').trigger('change');
  });
  