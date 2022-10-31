<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
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
                'text' => 'required|string'
            ],
            [
                'sender_email.required' => 'La mail è obbligatoria',
                'sender_email.email' => 'La mail inserita non è valida',
                'text.required' => 'Il testo del messaggio è obbligatorio',
            ]
        );

        //se la validazione fallisce mi da gli errori
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()]
            );
        }

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->flat_id = 1;
        $new_message->save();

        //chimata api per verificare 
        return response('Mail Sent' . 204);
    }
}
