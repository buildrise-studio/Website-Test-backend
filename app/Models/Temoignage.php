<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    protected $fillable = ['nom','entreprise','message','note','avatar','valide'];
    protected $casts    = ['valide' => 'boolean', 'note' => 'integer'];
}