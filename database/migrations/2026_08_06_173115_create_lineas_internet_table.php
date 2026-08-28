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
        Schema::create('lineas_internet', function (Blueprint $table) {
            $table->increments('id_linea');
            $table->unsignedInteger('id_edificio');
            $table->enum('proveedor', ['Telmex', 'Izzi', 'Otro']);
            $table->string('numero_contrato', 50);
            $table->string('numero_telefono', 20)->nullable();
            $table->string('ubicacion_especifica', 150)->nullable();
            $table->string('modelo_modem', 100)->nullable();
            $table->string('ip_publica', 45)->nullable();
            $table->enum('estatus_linea', ['Activa', 'Inactiva', 'En_revision'])->default('Activa');
            $table->text('observaciones')->nullable();

            $table->foreign('id_edificio')
                ->references('id_edificio')
                ->on('edificios')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas_internet');
    }
};
