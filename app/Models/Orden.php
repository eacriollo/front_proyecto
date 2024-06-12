<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    public function abonado(){
        return $this->belongsTo(Abonado::class);
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function precio(){
        return $this->belongsTo(Precio::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
