<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'tipo_documento',
        'numero_documento',
        'tipo_servicio',
        'dia',
        'hora',
        'estado',
        'observaciones',
    ];

    /**
     * Relación: Una cita pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accesor para mostrar nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
