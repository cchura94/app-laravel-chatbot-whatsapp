<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }
}
