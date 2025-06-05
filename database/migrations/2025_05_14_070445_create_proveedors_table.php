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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre comercial
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('rfc')->nullable(); // RFC fiscal (opcional)
            $table->string('curp')->nullable(); // CURP fiscal (opcional)
            $table->string('nit')->unique();   // Número de proveedor interno
            $table->string('telefono');
            $table->string('email');
            $table->string('estado')->default('activo'); // activo / inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
