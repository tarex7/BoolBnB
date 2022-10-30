<?php
namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Sponsorship;
use LDAP\Result;

class OrderController extends Controller
{
    public function generate(Request $request,Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data =[
            'success'=>'true',
            'token'=>$token,
        ];

        return response()->json($data,200);
    }
    public function makePayment(OrderRequest $request,Gateway $gateway){

        $sponsorship = Sponsorship::find($request->sponsorship);
        $result = $gateway->transaction()->sale([
            'amount'=>$sponsorship->price,
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
