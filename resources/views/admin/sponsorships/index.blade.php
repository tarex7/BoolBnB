@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row payment-options">
    @foreach ($sponsorships as $sponsorship)
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">    
        <div class="card payment-col mx-sm-auto mx-md-0">
          <div class="sponsorship-name {{$sponsorship->name}}">{{$sponsorship->name}}</div> 
          <div class="payment-info">
            <div class="my-2">
              <div class="pointer btn ms-btn" onclick="createPayment({{$sponsorship->id}}, '{{$tokenAutorization}}', {{ $flat }})">Paga</div>
              <h4>Dettagli: </h4>
              <div>Ore: {{$sponsorship->duration}}</div>
              <div>Prezzo: {{$sponsorship->price}} €</div>
            </div>          
          </div>
        </div>
      </div>
    @endforeach 
  </div>

  <div id="dropin-wrapper">
    <div id="checkout-message"></div>
    <div id="dropin-container"></div>
    <button id="submit-button">Submit payment</button>
  </div>
  <script>
    var button = document.querySelector('#submit-button');
  
    braintree.dropin.create({
      // Insert your tokenization key here
      authorization: 'sandbox_9q5fkbs6_88shqs3gnqq3267x',
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
          // When the user clicks on the 'Submit payment' button this code will send the
          // encrypted payment information in a variable called a payment method nonce
          $.ajax({
            type: 'POST',
            url: '/checkout',
            data: {'paymentMethodNonce': payload.nonce}
          }).done(function(result) {
            // Tear down the Drop-in UI
            instance.teardown(function (teardownErr) {
              if (teardownErr) {
                console.error('Could not tear down Drop-in UI!');
              } else {
                console.info('Drop-in UI has been torn down!');
                // Remove the 'Submit payment' button
                $('#submit-button').remove();
              }
            });
  
            if (result.success) {
              $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
            } else {
              console.log(result);
              $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
            }
          });
        });
      });
    });
  </script>
@endsection