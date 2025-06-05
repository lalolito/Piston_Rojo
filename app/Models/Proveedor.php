<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre',
        'razon_social',
        'direccion',
        'rfc',
        'curp',
        'nit',
        'telefono',
        'email',
        'estado',
    ];

    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
