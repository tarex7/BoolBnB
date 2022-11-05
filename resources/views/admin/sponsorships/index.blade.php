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

  <div id="dropin-wrapper" class="payment-wrapper">
    <div id="checkout-message"></div>
    <div id="dropin-container"></div>
    <button id="submit-button" class="btn ms-btn">Submit payment</button>
  </div>
</div>
  <!-- includes the Braintree JS client SDK -->
  <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>

  <!-- includes jQuery -->
  <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
  <script>

    var button_type = document.querySelector('#submit-button').style.display = "none"

    function createPayment(id,tokenAutorization,flat){

      $('#dropin-container').html("");
      var button_type = document.querySelector('#submit-button').style.display = "block";
      var button = document.querySelector('#submit-button');
      
      braintree.dropin.create({
        // Insert your tokenization key here
        authorization: tokenAutorization,
        container: '#dropin-container'
      }, function (createErr, instance) {
        button.addEventListener('click', function () {
          instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            // When the user clicks on the 'Submit payment' button this code will send the
            // encrypted payment information in a variable called a payment method nonce
            $.ajax({
              type: 'POST',
              url: 'http://127.0.0.1:8000/api/make/payment',
              data: {
                      "token": payload.nonce,
                      "product" : id,
                      "flat" : flat
                    }
            }).done(function(result) {
              console.log(result);
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
                $('#checkout-message').html('<h1>Success</h1><p class="text-center">il tuo pagamento è andato a buon fine</p>');
                setTimeout(() => {
                  location.href = 'http://127.0.0.1:8000/admin/flats';
                }, 5000); 
              } else {
                console.log(result);
                $('#checkout-message').html('<h1>Retry</h1><p>il tuo pagamento non è andato a buon fine</p>');
              }
            });
          });
        });
      });
    }
   
  </script>
@endsection