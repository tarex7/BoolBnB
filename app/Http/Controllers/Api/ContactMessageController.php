<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function send(Request $request)
    {
        // Raccogliamo tutti i dati
        $data  = $request->all();

        // Validazione 
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'message' => 'required|string'
            ],
            [
                'email.required' => 'La mail è obbligatoria',
                'email.email' => 'La mail inserita non è valida',
                'message.required' => 'Il testo del messaggio è obbligatorio',
            ]
        );

        //se la validazione fallisce mi da gli errori
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()]
            );
        }

        //chimata api per verificare 
        return response()->json($data);
    }
}
