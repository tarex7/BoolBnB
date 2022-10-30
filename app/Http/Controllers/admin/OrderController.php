<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(OrderRequest $request,Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data =[
            'success'=>'true',
            'token'=>$token,
        ];

        return response()->json($data,200);
    }
    public function makePayment(OrderRequest $request,Gateway $gateway){
        $result = $gateway->transaction()->sale([
            'amount'=>$request->amount,
            'paymentMethodNonce'=> $request->token,
            'options'=>[
                'submitForSettlement'=>true,
            ]

        ]);
        if($result->success){
            $data =[
                'success'=>'true',
                'message'=>"Transaziomne eseguita con successo",
            ];
            return response()->json($data,200);
        }else{
            $data =[
                'success'=>'false',
                'message'=>"Transazione Fallita",
            ];
            return response()->json($data,401);
        }

    }
}
