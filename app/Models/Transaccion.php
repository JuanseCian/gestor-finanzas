<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';

    protected $fillable = [
        'usuario_id',
        'tipo',
        'monto',
        'descripcion',
        'categoria_id',
        'metodo_id',
        'fecha'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function metodo()
    {
        return $this->belongsTo(Metodo::class);
    }
}