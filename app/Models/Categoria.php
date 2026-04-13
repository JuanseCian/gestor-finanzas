<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'tipo'
    ];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}