<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Velo extends Model
{
    protected $fillable=[
        'nom_velo','year','price_day','disponibilité','image','id_model'
    ];
    protected $primaryKey = 'id_velo';

    public function modele(): BelongsTo
    {
        return $this->belongsTo(Modele::class, 'id_model');
    }
}

