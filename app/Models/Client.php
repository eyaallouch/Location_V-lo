<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable=[
        'cin','age','number','id_user'
    ];
    protected $primaryKey = 'id_client';

    public function User(): HasOne
    {
        return $this->hasOne(User::class,'id_user');
    }
    // public function Location(): HasMany
    // {
    //     return $this->hasMany(Location::class,'id_location');
    // }
}
