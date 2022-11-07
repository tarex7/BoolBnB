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
        <div id="dropin-wrapper" class="payment-wrapper my-5">
            <div id="checkout-message"></div>
            <div id="dropin-container"></div>
            <button id="submit-button" class="btn btn-primary ms-btn">Invia il pagamento</button>
        </div>
    </div>
    </div>
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script>
        var button_type = document.querySelector('#submit-button').style.display = "none"

        function createPayment(id, tokenAutorization, flat) {
            $('#dropin-container').html("");
            var button_type = document.querySelector('#submit-button').style.display = "block";
            var button = document.querySelector('#submit-button');
            braintree.dropin.create({
                // Insert your tokenization key here
                authorization: tokenAutorization,
                container: '#dropin-container'
            }, function(createErr, instance) {
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                        // When the user clicks on the 'Submit payment' button this code will send the
                        // encrypted payment information in a variable called a payment method nonce
                        $.ajax({
                            console.log(payload.nonce);
                            type: 'POST',
                            url: 'http://127.0.0.1:8000/api/orders/make/payment',
                            data: {
                                "token": payload.nonce,
                                "product": id,
                                "flat": flat
                            }
                        }).done(function(result) {
                            console.log(result);
                            // Tear down the Drop-in UI
                            instance.teardown(function(teardownErr) {
                                if (teardownErr) {
                                    console.error(
                                        'Could not tear down Drop-in UI!');
                                } else {
                                    console.info('Drop-in UI has been torn down!');
                                    // Remove the 'Submit payment' button
                                    $('#submit-button').remove();
                                }
                            });
                            if (result.success) {
                                $('#checkout-message').html(
                                    '<h1>Success</h1><p class="text-center">il tuo pagamento è andato a buon fine</p>'
                                );
                                setTimeout(() => {
                                    location.href =
                                        'http://127.0.0.1:8000/admin/flats';
                                }, 5000);
                            } else {
                                console.log(result);
                                $('#checkout-message').html(
                                    '<h1>Retry</h1><p>il tuo pagamento non è andato a buon fine</p>'
                                );
                            }
                        });
                    });
                });
            });
        }
    </script>
@endsection
