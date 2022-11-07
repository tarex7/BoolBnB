@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-5">Scegli la tua sponsorizzazione</h1>
            </div>
            @foreach ($sponsorships as $sponsorship)
                <div class="col mt-5 ">

                    <div class="card basic mt-3">
                        <h1 class="text-center my-3">{{ $sponsorship->name }}</h1>
                        <div class="border"></div>
                        <p class="h4 p-3 my-5 text-center">Il tuo appartamento sarà sponsorizzato per <strong
                                class="h2 fw-bold">{{ $sponsorship->duration }}</strong> ore!</p>
                        <div class="border"></div>
                        <h1 class="text-center display-4 my-4"> € {{ $sponsorship->price }} </h1>
                        <div class="d-flex justify-content-center my-5">
                            <a onclick="createPayment({{ $sponsorship->id }}, '{{ $tokenAutorization }}', {{ $flat }})"
                                class="btn btn-success btn-lg rounded-0 w-50">Scegli</a>

                            {{--  --}}
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
            }, function(createErr, instance) {
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                        // When the user clicks on the 'Submit payment' button this code will send the
                        // encrypted payment information in a variable called a payment method nonce
                        $.ajax({
                            type: 'POST',
                            url: '/checkout',
                            data: {
                                'paymentMethodNonce': payload.nonce
                            }
                        }).done(function(result) {
                            // Tear down the Drop-in UI
                            instance.teardown(function(teardownErr) {
                                if (teardownErr) {
                                    console.error('Could not tear down Drop-in UI!');
                                } else {
                                    console.info('Drop-in UI has been torn down!');
                                    // Remove the 'Submit payment' button
                                    $('#submit-button').remove();
                                }
                            });

                            if (result.success) {
                                $('#checkout-message').html(
                                    '<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>'
                                    );
                            } else {
                                console.log(result);
                                $('#checkout-message').html(
                                    '<h1>Error</h1><p>Check your console.</p>');
                            }
                        });
                    });
                });
            });


            //////////////////////


          
        </script>
    @endsection
