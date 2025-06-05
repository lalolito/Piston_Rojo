<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            // Identificador único
            $table->id();
            
            // Relación con usuarios (con eliminación en cascada)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade')
                  ->comment('Usuario que agenda la cita');
            
            // Datos personales del cliente
            $table->string('nombre', 50)
                  ->comment('Nombre del cliente');
            $table->string('apellido', 50)
                  ->comment('Apellido del cliente');
            
            // Documento de identidad
            $table->enum('tipo_documento', ['cc', 'ti', 'cxe', 'pasaporte'])
                  ->comment('cc: Cédula de ciudadanía, ti: Tarjeta de identidad, cxe: Cédula de extranjería');
            $table->string('numero_documento', 20)
                  ->comment('Número de documento de identidad');
            
            // Información del servicio
            $table->enum('tipo_servicio', [
                    'cambio_aceite', 
                    'revision_general', 
                    'mantenimiento_general',
                    'alineacion',
                    'frenos',
                    'suspension',
                    'electrico'
                ])
                ->comment('Tipo de servicio solicitado');
            
            // Fecha y hora de la cita
            $table->date('dia')
                  ->comment('Fecha de la cita');
            $table->time('hora')
                  ->comment('Hora de la cita');
            
            // Estado y seguimiento
            $table->enum('estado', [
                    'pendiente', 
                    'confirmada', 
                    'completada', 
                    'cancelada',
                    'no_asistio'
                ])
                ->default('pendiente')
                ->comment('Estado actual de la cita');
            
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales');
            
            // Auditoría
            $table->timestamps();
            
            // Índices para mejor performance
            $table->index('dia');
            $table->index('hora');
            $table->index('estado');
            
            // Restricciones de unicidad
            $table->unique(['numero_documento', 'dia', 'hora'], 'citas_documento_fecha_hora_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};