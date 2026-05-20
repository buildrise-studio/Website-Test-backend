<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
class PublicFaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::where('actif', true)->orderBy('ordre');
        if ($request->filled('per_page')) return response()->json($query->paginate($request->per_page));
        return response()->json($query->get());
    }
}