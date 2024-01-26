<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $fillable=[
        'id_model','nom_model'
    ];
    protected $primaryKey = 'id_model';

    public function Velo(): HasMany
    {
        return $this->hasMany(Velo::class, 'id_velo');
    }
}
