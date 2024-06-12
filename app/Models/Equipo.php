<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function abonado(){
        return $this->belongsTo(Abonado::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    
}
