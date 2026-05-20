<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'categorie',
        'technologies', 'url', 'image',
        'annee', 'ordre', 'actif', 'emoji',
    ];

    protected $casts = [
        'technologies' => 'array',
        'actif'        => 'boolean',
        'ordre'        => 'integer',
        'annee'        => 'integer',
    ];
}