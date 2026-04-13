<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
    protected $table = 'metodos';

    protected $fillable = [
        'nombre',
        'requiere_origen'
    ];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}