<?php

use App\Models\Edificio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('el CRUD de edificios permite crear, editar y eliminar registros', function () {
    $user = User::factory()->create(['curp' => 'TEST123456EDI001', 'tipo' => 1]);

    $this->actingAs($user);

    $this->post(route('edificios.store'), [
        'nombre' => 'Edificio Central',
        'direccion' => 'Av. Principal 100',
    ])->assertRedirect(route('edificios.index'));

    $edificio = Edificio::query()->where('nombre', 'Edificio Central')->firstOrFail();

    $this->put(route('edificios.update', $edificio), [
        'nombre' => 'Edificio Norte',
        'direccion' => 'Av. Principal 100',
    ])->assertRedirect(route('edificios.index'));

    $this->delete(route('edificios.destroy', $edificio))
        ->assertRedirect(route('edificios.index'));

    $this->assertDatabaseMissing('edificios', ['id_edificio' => $edificio->id_edificio]);
});

test('la ruta de edificios se muestra dentro del módulo protegido de reportes de red', function () {
    $user = User::factory()->create(['curp' => 'TEST123456EDI002', 'tipo' => 1]);

    $this->actingAs($user)
        ->get(route('edificios.index'))
        ->assertSuccessful()
        ->assertViewIs('admin.edificios.index');
});
