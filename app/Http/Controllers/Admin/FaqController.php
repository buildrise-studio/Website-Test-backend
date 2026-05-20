<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json(Faq::orderBy('ordre')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'  => ['required', 'string', 'max:500'],
            'reponse'   => ['required', 'string'],
            'categorie' => ['nullable', 'string', 'max:100'],
            'ordre'     => ['nullable', 'integer'],
            'actif'     => ['nullable', 'boolean'],
        ]);

        return response()->json(Faq::create($data), 201);
    }

    public function show(Faq $faq)
    {
        return response()->json($faq);
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question'  => ['sometimes', 'string', 'max:500'],
            'reponse'   => ['sometimes', 'string'],
            'categorie' => ['nullable', 'string'],
            'ordre'     => ['nullable', 'integer'],
            'actif'     => ['nullable', 'boolean'],
        ]);

        $faq->update($data);
        return response()->json($faq);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->json(['message' => 'FAQ supprimée.']);
    }

    public function updateOrdre(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update(['ordre' => $request->validate(['ordre' => 'required|integer'])['ordre']]);
        return response()->json($faq);
    }
}