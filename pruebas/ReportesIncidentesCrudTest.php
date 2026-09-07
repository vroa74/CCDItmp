<?php

use App\Models\Edificio;
use App\Models\LineaInternet;
use App\Models\ReporteIncidente;
use App\Models\SeguimientoSubreporte;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('un reporte de incidente puede tener varios seguimientos', function () {
    $user = User::factory()->create(['curp' => 'TEST123456INC001', 'tipo' => 1]);
    $edificio = Edificio::create(['nombre' => 'Edificio de Incidentes', 'direccion' => 'Av. Central 10']);
    $linea = LineaInternet::create([
        'id_edificio' => $edificio->id_edificio,
        'proveedor' => 'Telmex',
        'numero_contrato' => 'INC-001',
        'estatus_linea' => 'Activa',
    ]);

    $this->actingAs($user);

    $this->post(route('reportes-incidentes.store'), [
        'id_linea' => $linea->id_linea,
        'folio_ticket_proveedor' => 'TICKET-001',
        'tipo_falla' => 'Sin_servicio',
        'descripcion_problema' => 'Sin conectividad en el edificio.',
        'prioridad' => 'Alta',
        'estatus' => 'En_proceso',
        'fecha_apertura' => '2026-09-07 10:00',
    ])->assertRedirect();

    $reporte = ReporteIncidente::query()->firstOrFail();

    foreach (['Se notificó al proveedor.', 'El proveedor confirmó la revisión.'] as $comentarios) {
        $this->post(route('reportes-incidentes.seguimientos.store', $reporte), [
            'folio_subreporte_proveedor' => 'SUB-001',
            'fecha_registro' => '2026-09-07 11:00',
            'comentarios' => $comentarios,
            'nombre_tecnico_proveedor' => 'Técnico de guardia',
            'proxima_accion' => 'Validar servicio.',
        ])->assertRedirect(route('reportes-incidentes.show', $reporte));
    }

    expect($reporte->seguimientos()->count())->toBe(2);

    $seguimiento = $reporte->seguimientos()->firstOrFail();
    $this->put(route('reportes-incidentes.seguimientos.update', [$reporte, $seguimiento]), [
        'fecha_registro' => '2026-09-07 12:00',
        'comentarios' => 'Seguimiento actualizado.',
    ])->assertRedirect(route('reportes-incidentes.show', $reporte));

    $this->delete(route('reportes-incidentes.destroy', $reporte))
        ->assertRedirect(route('reportes-incidentes.index'));

    expect(SeguimientoSubreporte::query()->where('id_reporte', $reporte->id_reporte)->count())->toBe(0);
});
