<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::orderBy('ordre')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'slug'         => ['required', 'string', 'unique:services,slug'],
            'description'  => ['required', 'string'],
            'icone'        => ['nullable', 'string'],
            'couleur'      => ['nullable', 'string'],
            'features'     => ['nullable', 'array'],
            'prix_depuis'  => ['nullable', 'string'],
            'delai'        => ['nullable', 'string'],
            'ordre'        => ['nullable', 'integer'],
            'actif'        => ['nullable', 'boolean'],
        ]);

        return response()->json(Service::create($data), 201);
    }

    public function show(Service $service)
    {
        return response()->json($service);
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'titre'        => ['sometimes', 'string', 'max:255'],
            'slug'         => ['sometimes', 'string', "unique:services,slug,{$service->id}"],
            'description'  => ['sometimes', 'string'],
            'icone'        => ['nullable', 'string'],
            'couleur'      => ['nullable', 'string'],
            'features'     => ['nullable', 'array'],
            'prix_depuis'  => ['nullable', 'string'],
            'delai'        => ['nullable', 'string'],
            'ordre'        => ['nullable', 'integer'],
            'actif'        => ['nullable', 'boolean'],
        ]);

        $service->update($data);
        return response()->json($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Service supprimé.']);
    }
}