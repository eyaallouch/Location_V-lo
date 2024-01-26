<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=[
        'id_client','id_velo','datedebut','datefin'
    ];
    public function Client(): HasOne
    {
        return $this->hasOne(Client::class,'id_client');
    }
}
