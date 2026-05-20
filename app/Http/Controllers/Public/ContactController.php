<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'        => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255'],
            'telephone'  => ['nullable', 'string', 'max:30'],
            'entreprise' => ['nullable', 'string', 'max:255'],
            'service'    => ['nullable', 'string', 'max:100'],
            'budget'     => ['nullable', 'string', 'max:100'],
            'message'    => ['required', 'string', 'min:20'],
        ]);

        // Sauvegarder en BDD
        $message = Message::create(array_merge($data, ['lu' => false]));

        // Envoyer un email de notification à l'admin (optionnel)
        // Mail::to(config('mail.from.address'))->send(new \App\Mail\NouveauContact($message));

        return response()->json([
            'success' => true,
            'message' => 'Votre message a été envoyé. Nous vous répondrons dans les 24h.',
        ], 201);
    }
}