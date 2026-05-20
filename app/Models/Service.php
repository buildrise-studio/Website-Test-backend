<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'icone',
        'couleur', 'features', 'prix_depuis', 'delai',
        'ordre', 'actif',
    ];

    protected $casts = [
        'features' => 'array',
        'actif'    => 'boolean',
    ];
}