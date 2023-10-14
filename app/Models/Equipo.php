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

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function orden(){
        return $this->hasMany(Orden::class);
    }

    
}
