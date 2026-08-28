<?php

use App\Livewire\Admin\Usuarios\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componente livewire admin usuarios se puede renderizar y listar usuarios', function () {
    $user = User::factory()->create([
        'name' => 'Admin Test',
        'email' => 'admin@test.com',
        'curp' => 'TEST123456TEST01',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Index::class)
        ->assertStatus(200)
        ->assertSee('Admin Test')
        ->assertSee('admin@test.com');
});

test('ruta de gestion de usuarios carga la vista admin.usuarios.index para admin', function () {
    $admin = User::factory()->create([
        'curp' => 'TEST123456TEST02',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($admin)->get(route('usuarios.index'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.usuarios.index');
    $response->assertSeeLivewire(Index::class);
});

test('campo nivel tiene valor por defecto 1 en el formulario y se carga al editar con opciones hasta 12', function () {
    $admin = User::factory()->create([
        'curp' => 'TEST123456TEST03',
        'tipo' => 1,
        'lvl' => '12',
    ]);

    $this->actingAs($admin);

    Livewire::test(Index::class)
        ->assertSet('lvl', '1')
        ->call('openModal')
        ->assertSet('lvl', '1')
        ->call('editUser', $admin->id)
        ->assertSet('lvl', '12');
});
