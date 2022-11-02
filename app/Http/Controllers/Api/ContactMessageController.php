<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;

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
                'sender_email' => 'required|email',
                'text' => 'required|string',
                'sender_name' => "required|string",
                'object' => "required|string"
            ],
            [
                'sender_email.required' => 'La mail è obbligatoria',
                'sender_email.email' => 'La mail inserita non è valida',
                'text.required' => 'Il testo del messaggio è obbligatorio',
                'sender_name' => 'Il nome è obbligatorio',
                'object' => 'L\'oggetto è obbligatorio',
            ]
        );

        //se la validazione fallisce mi da gli errori
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()]
            );
        }

        //Salvo i dati nel database
        $new_message = new Message();
        $new_message->fill($data);
        $new_message->flat_id = 1;
        $new_message->save();

        //Se il validatore passa o no ho questa riposta
        if ($validator->fails()) return response()->json('Il messaggio non è stato inviato');
        else return response()->json('IL messaggio è stato inviato correttamente' . 204);
    }
}
