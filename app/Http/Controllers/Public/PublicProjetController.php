<?php
// ─── PublicProjetController.php ──────────────────────────────────────────
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\Request;

class PublicProjetController extends Controller
{
    public function index(Request $request)
    {
        $query = Projet::where('actif', true)->orderBy('ordre')->orderByDesc('annee');

        if ($request->filled('categorie') && $request->categorie !== 'Tous') {
            $query->where('categorie', $request->categorie);
        }

        $projets = $request->filled('per_page')
            ? $query->paginate($request->per_page)
            : $query->get();

        return response()->json($projets);
    }

    public function show($id)
    {
        return response()->json(Projet::where('actif', true)->findOrFail($id));
    }
}