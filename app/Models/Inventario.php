<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descripcion',
        'categoria',
        'proveedor_id',
        'cantidad',
        'precio_unitario',
        'valor_total',
        'estado_stock',
        'estado'
    ];

    public const STOCK_SIN = 'sin_stock';
    public const STOCK_BAJO = 'bajo_stock';
    public const STOCK_MEDIO = 'medio_stock';
    public const STOCK_ALTO = 'alto_stock';

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
