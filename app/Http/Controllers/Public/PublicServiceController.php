<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Service;
class PublicServiceController extends Controller
{
    public function index() { return response()->json(Service::where('actif', true)->orderBy('ordre')->get()); }
    public function show($slug) { return response()->json(Service::where('slug', $slug)->where('actif', true)->firstOrFail()); }
}