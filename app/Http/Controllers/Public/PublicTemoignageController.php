<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Temoignage;
class PublicTemoignageController extends Controller
{
    public function index() { return response()->json(Temoignage::where('valide', true)->latest()->get()); }
}