<?php

namespace App\Http\Controllers\Api\Orders;

use Braintree\Gateway;
use App\Models\Sponsorship;
use Braintree\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();


        $data = [
            'success' => true,
            'token' => $token,
        ];

        return response()->json($data, 200);
    }



    

    public function makePayment(OrderRequest $request, Gateway $gateway)
    {

        

require_once 'PATH_TO_BRAINTREE/lib/Braintree.php';

// Instantiate a Braintree Gateway either like this:
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'your_merchant_id',
    'publicKey' => 'your_public_key',
    'privateKey' => 'your_private_key'
]);

// or like this:
$config = new Configuration([
    'environment' => 'sandbox',
    'merchantId' => 'your_merchant_id',
    'publicKey' => 'your_public_key',
    'privateKey' => 'your_private_key'
]);
$gateway = new Braintree\Gateway($config);

// Then, create a transaction:
$result = $gateway->transaction()->sale([
    'amount' => '10.00',
    'paymentMethodNonce' => $nonceFromTheClient,
    'deviceData' => $deviceDataFromTheClient,
    'options' => [ 'submitForSettlement' => True ]
]);

if ($result->success) {
    print_r("success!: " . $result->transaction->id);
} else if ($result->transaction) {
    print_r("Error processing transaction:");
    print_r("\n  code: " . $result->transaction->processorResponseCode);
    print_r("\n  text: " . $result->transaction->processorResponseText);
} else {
    foreach($result->errors->deepAll() AS $error) {
      print_r($error->code . ": " . $error->message . "\n");
    }
}
    }
}
