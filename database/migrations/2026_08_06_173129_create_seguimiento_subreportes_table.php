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
        Schema::create('seguimiento_subreportes', function (Blueprint $table) {
            $table->increments('id_subreporte');
            $table->unsignedInteger('id_reporte');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('folio_subreporte_proveedor', 50)->nullable();
            $table->dateTime('fecha_registro')->useCurrent();
            $table->text('comentarios');
            $table->string('nombre_tecnico_proveedor', 100)->nullable();
            $table->string('proxima_accion', 255)->nullable();

            $table->foreign('id_reporte')
                ->references('id_reporte')
                ->on('reportes_incidentes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_subreportes');
    }
};
