<?php

use App\Livewire\Admin\Catalogo\Index as CatalogoIndex;
use App\Livewire\Admin\Estudiante\Index as EstudianteIndex;
use App\Livewire\Admin\Reportes\Create as ReportesCreate;
use App\Livewire\Admin\Reportes\Edit as ReportesEdit;
use App\Livewire\Admin\Reportes\Index as ReportesIndex;
use App\Livewire\Admin\Usuario\Index as UsuarioIndex;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componentes y rutas de catalogo se renderizan correctamente', function () {
    $user = User::factory()->create(['curp' => 'TEST123456CAT001', 'tipo' => 1]);

    $this->actingAs($user);

    Livewire::test(CatalogoIndex::class)
        ->assertStatus(200);

    $this->get('/catalogo')
        ->assertStatus(200)
        ->assertViewIs('admin.catalogo.index');

    $this->get('/materias')
        ->assertStatus(200)
        ->assertViewIs('admin.catalogo.index');
});

test('componentes y rutas de reportes se renderizan y muestran datos del usuario', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456REP001',
        'name' => 'Usuario Reporte',
        'email' => 'reporte@test.com',
        'lvl' => '5',
        'status' => true,
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(ReportesIndex::class)
        ->assertStatus(200)
        ->assertSee('Usuario Reporte')
        ->assertSee('reporte@test.com')
        ->assertSee('Nivel 5')
        ->assertSee('Activo');

    $this->get('/reportes')
        ->assertStatus(200)
        ->assertViewIs('admin.reportes.index');

    Livewire::test(ReportesCreate::class)
        ->assertStatus(200);

    $this->get('/reportes/create')
        ->assertStatus(200)
        ->assertViewIs('admin.reportes.create');

    Livewire::test(ReportesEdit::class, ['id' => 1])
        ->assertStatus(200);

    $this->get('/reportes/edit/1')
        ->assertStatus(200)
        ->assertViewIs('admin.reportes.edit');
});

test('componentes y rutas de estudiante y usuario se renderizan correctamente', function () {
    $user = User::factory()->create(['curp' => 'TEST123456EST001', 'name' => 'Test Estudiante', 'tipo' => 1]);

    $this->actingAs($user);

    Livewire::test(EstudianteIndex::class)
        ->assertStatus(200);

    $this->get('/estudiante')
        ->assertStatus(200)
        ->assertViewIs('admin.estudiante.index');

    Livewire::test(UsuarioIndex::class)
        ->assertStatus(200)
        ->assertSee('Test Estudiante');

    $this->get('/usuario')
        ->assertStatus(200)
        ->assertViewIs('admin.usuario.index');
});
