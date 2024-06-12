<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function ordenes(){
        return $this->hasMany(Orden::class);
    }

    public function equipos(){
        return $this->hasMany(Orden::class);
    }

}
