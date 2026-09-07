<?php

use App\Models\Edificio;
use App\Models\LineaInternet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('el CRUD de líneas de internet permite crear, actualizar y eliminar una línea vinculada a un edificio', function () {
    $user = User::factory()->create(['curp' => 'TEST123456LIN001', 'tipo' => 1]);
    $edificio = Edificio::create(['nombre' => 'Edificio de Redes', 'direccion' => 'Av. Principal 100']);

    $this->actingAs($user);

    $this->post(route('lineas-internet.store'), [
        'id_edificio' => $edificio->id_edificio,
        'proveedor' => 'Telmex',
        'numero_contrato' => 'CONTRATO-001',
        'numero_telefono' => '5555555555',
        'ubicacion_especifica' => 'Sala de servidores',
        'modelo_modem' => 'Modem X1',
        'ip_publica' => '192.0.2.10',
        'estatus_linea' => 'Activa',
        'observaciones' => 'Línea principal',
    ])->assertRedirect(route('lineas-internet.index'));

    $linea = LineaInternet::query()->firstOrFail();
    expect($linea->edificio->nombre)->toBe('Edificio de Redes');

    $this->put(route('lineas-internet.update', $linea), [
        'id_edificio' => $edificio->id_edificio,
        'proveedor' => 'Izzi',
        'numero_contrato' => 'CONTRATO-002',
        'estatus_linea' => 'En_revision',
    ])->assertRedirect(route('lineas-internet.index'));

    $this->delete(route('lineas-internet.destroy', $linea))
        ->assertRedirect(route('lineas-internet.index'));

    $this->assertDatabaseMissing('lineas_internet', ['id_linea' => $linea->id_linea]);
});

test('una línea de internet requiere un edificio existente', function () {
    $user = User::factory()->create(['curp' => 'TEST123456LIN002', 'tipo' => 1]);

    $this->actingAs($user)
        ->post(route('lineas-internet.store'), [
            'id_edificio' => 999999,
            'proveedor' => 'Telmex',
            'numero_contrato' => 'CONTRATO-INVALIDO',
            'estatus_linea' => 'Activa',
        ])
        ->assertSessionHasErrors('id_edificio');
});
