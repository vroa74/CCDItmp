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
        Schema::create('reportes_incidentes', function (Blueprint $table) {
            $table->increments('id_reporte');
            $table->unsignedInteger('id_linea');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('folio_ticket_proveedor', 50)->nullable();
            $table->enum('tipo_falla', ['Sin_servicio', 'Intermitencia', 'Lentitud', 'Falla_hardware', 'Desconexiones', 'LOS (falla de fibraoptica)','Otro']);
            $table->string('nombre_tecnico_proveedor', 100)->nullable();
            $table->text('descripcion_problema');
            $table->enum('prioridad', ['Baja', 'Media', 'Alta', 'Critica'])->default('Media');
            $table->enum('estatus', ['Abierto', 'En_proceso', 'Escalado', 'Resuelto', 'Cerrado'])->default('Abierto');
            $table->dateTime('fecha_apertura')->useCurrent();
            $table->dateTime('fecha_cierre')->nullable();

            $table->foreign('id_linea')
                ->references('id_linea')
                ->on('lineas_internet')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_incidentes');
    }
};
