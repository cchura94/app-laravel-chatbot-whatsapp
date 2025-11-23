<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

    protected $fillable = [
        'nombre',
        'nro_whatsapp',
        'nro_identificacion',
        'direccion',
        'menu_actual',
        'metadata'
    ];

    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }
}
