<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Temoignage;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'projets'      => Projet::count(),
            'services'     => Service::count(),
            'messages'     => Message::count(),
            'unread'       => Message::where('lu', false)->count(),
            'temoignages'  => Temoignage::count(),
            'faqs'         => Faq::count(),

            // Détails supplémentaires
            'projets_par_categorie' => Projet::selectRaw('categorie, count(*) as total')
                                             ->groupBy('categorie')->pluck('total', 'categorie'),

            'messages_recents' => Message::latest()->take(5)->get(['id', 'nom', 'email', 'service', 'message', 'lu', 'created_at']),

            'temoignages_en_attente' => Temoignage::where('valide', false)->count(),
        ]);
    }
}