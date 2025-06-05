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
    Schema::create('inventarios', function (Blueprint $table) {
        $table->id();
        $table->string('codigo')->unique(); // SKU
        $table->string('descripcion'); // marca, modelo, etc.
        $table->string('categoria'); // tornillos, bujías, etc.
        $table->foreignId('proveedor_id')->constrained('proveedors')->onDelete('cascade');
        $table->integer('cantidad')->default(0);
        $table->decimal('precio_unitario', 10, 2);
        $table->decimal('valor_total', 12, 2);
        $table->string('estado')->nullable(); // bueno, dañado, reparación
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
