
// thanh toan paypal 
    


     
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

   
        // lấy total price để thanh toán paypal
       
        var total = $('#getsubtotal').val();
        var usd = total*0.7;
    
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





