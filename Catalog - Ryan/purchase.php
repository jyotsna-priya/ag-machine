<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'ATaYxwWBe9qznmdTuSmXYEexdMY1dir_9gJGXwHA3cGAp8U24SsElKICf4yXcELoYZ9GjRquHipBfZd6',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'blue',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        redirect_urls:{
          return_url: 'http://localhost/execute-payment'
        },
        transactions: [{
          amount: {
            total: '100',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.redirect();
    }
  }, '#paypal-button');

</script>