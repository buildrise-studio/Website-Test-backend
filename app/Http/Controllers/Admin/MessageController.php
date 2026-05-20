<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::latest();

        if ($request->filled('lu')) {
            $query->where('lu', filter_var($request->lu, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('service')) {
            $query->where('service', $request->service);
        }

        $messages = $request->filled('per_page')
            ? $query->paginate($request->per_page)
            : $query->paginate(20);

        return response()->json($messages);
    }

    public function show(Message $message)
    {
        // Marquer comme lu automatiquement à l'ouverture
        if (!$message->lu) {
            $message->update(['lu' => true]);
        }
        return response()->json($message);
    }

    public function marquerLu(Message $message)
    {
        $message->update(['lu' => true]);
        return response()->json($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message supprimé.']);
    }
}