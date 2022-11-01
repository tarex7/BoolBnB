<?php
namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Sponsorship;
use App\Models\FlatSponsorship;
use App\Models\flat;
use Carbon\Carbon;
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

        $product = Sponsorship::findOrFail($request->product);
        $result = $gateway->transaction()->sale([
            'amount'=>$product->price,
            'paymentMethodNonce'=> $request->token,
            'options'=>[
                'submitForSettlement'=>true,
            ]

        ]);
        if($result->success){
            /* $flat = Flat::find($request->flat);
            $flat->is_sponsored = 1;
            $flat->update();  */
            $sponsorship = new Sponsorship();
            /* $sponsorship->flat_id = $request->flat; */
            $sponsorship->sponsorship_id = $request->product;
/*             $sponsorship->start_date = Carbon::now()->format('Y-m-d');
            $sponsorship->end_date = Carbon::now()->addHour($product->hour);
            $sponsorship->timestamps = false;
            $sponsorship->save(); */
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
