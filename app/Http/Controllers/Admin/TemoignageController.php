<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        return response()->json(Temoignage::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'        => ['required', 'string', 'max:255'],
            'entreprise' => ['nullable', 'string', 'max:255'],
            'message'    => ['required', 'string'],
            'note'       => ['nullable', 'integer', 'min:1', 'max:5'],
            'avatar'     => ['nullable', 'url'],
            'valide'     => ['nullable', 'boolean'],
        ]);

        return response()->json(Temoignage::create($data), 201);
    }

    public function show(Temoignage $temoignage)
    {
        return response()->json($temoignage);
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $request->validate([
            'nom'        => ['sometimes', 'string', 'max:255'],
            'entreprise' => ['nullable', 'string'],
            'message'    => ['sometimes', 'string'],
            'note'       => ['nullable', 'integer', 'min:1', 'max:5'],
            'avatar'     => ['nullable', 'url'],
            'valide'     => ['nullable', 'boolean'],
        ]);

        $temoignage->update($data);
        return response()->json($temoignage);
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();
        return response()->json(['message' => 'Témoignage supprimé.']);
    }

    public function valider(Temoignage $temoignage)
    {
        $temoignage->update(['valide' => ! $temoignage->valide]);
        return response()->json($temoignage);
    }
}