<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Campo apellido
            if (!Schema::hasColumn('users', 'apellido')) {
                $table->string('apellido')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'tipo_documento')) {
                $table->string('tipo_documento')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'numero_documento')) {
                $table->string('numero_documento')->nullable()->unique()->after('tipo_documento');
            }

            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono')->nullable()->after('numero_documento');
            }

            if (!Schema::hasColumn('users', 'fecha_nacimiento')) {
                $table->date('fecha_nacimiento')->nullable()->after('telefono');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('cliente')->after('fecha_nacimiento');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'apellido',
                'tipo_documento',
                'numero_documento',
                'telefono',
                'fecha_nacimiento',
                'role'
            ]);
        });
    }
};
