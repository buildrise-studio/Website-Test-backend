<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index(Request $request)
    {
        $query = Projet::orderBy('ordre')->orderByDesc('created_at');

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('q')) {
            $query->where('titre', 'like', "%{$request->q}%");
        }

        $projets = $request->filled('per_page')
            ? $query->paginate($request->per_page)
            : $query->get();

        return response()->json($projets);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'categorie'    => ['required', 'in:Vitrine,E-commerce,App Web,ERP/CRM'],
            'technologies' => ['nullable'],  // array ou string
            'url'          => ['nullable', 'url'],
            'image'        => ['nullable', 'url'],
            'annee'        => ['nullable', 'integer', 'min:2000', 'max:2099'],
            'ordre'        => ['nullable', 'integer'],
            'actif'        => ['nullable', 'boolean'],
        ]);

        // Normaliser technologies en JSON
        if (isset($data['technologies']) && is_string($data['technologies'])) {
            $data['technologies'] = array_filter(array_map('trim', explode(',', $data['technologies'])));
        }

        $projet = Projet::create($data);

        return response()->json($projet, 201);
    }

    public function show(Projet $projet)
    {
        return response()->json($projet);
    }

    public function update(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'titre'        => ['sometimes', 'required', 'string', 'max:255'],
            'description'  => ['sometimes', 'required', 'string'],
            'categorie'    => ['sometimes', 'in:Vitrine,E-commerce,App Web,ERP/CRM'],
            'technologies' => ['nullable'],
            'url'          => ['nullable', 'url'],
            'image'        => ['nullable', 'url'],
            'annee'        => ['nullable', 'integer'],
            'ordre'        => ['nullable', 'integer'],
            'actif'        => ['nullable', 'boolean'],
        ]);

        if (isset($data['technologies']) && is_string($data['technologies'])) {
            $data['technologies'] = array_filter(array_map('trim', explode(',', $data['technologies'])));
        }

        $projet->update($data);

        return response()->json($projet);
    }

    public function destroy(Projet $projet)
    {
        $projet->delete();
        return response()->json(['message' => 'Projet supprimé.']);
    }

    public function updateOrdre(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);
        $projet->update(['ordre' => $request->validate(['ordre' => 'required|integer'])['ordre']]);
        return response()->json($projet);
    }
}