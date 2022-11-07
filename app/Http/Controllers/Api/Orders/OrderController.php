<?php

namespace App\Http\Controllers\Api\Orders;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Sponsorship;

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

        $sponsorship = Sponsorship::find($request->sponsorship);

        $result = $gateway->transaction()->sale(
            [
                'amount' => $sponsorship->price,
                'paymentMethodNonce' => $request->token,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]
        );

        if ($result->success) {

            $data = [
                'success' => true,
                'message' => "Transazione eseguita con successo",
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'token' => "Transazione fallita",
            ];
            return response()->json($data, 200);
        }
    }
}
