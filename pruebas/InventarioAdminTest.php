<?php

use App\Livewire\Admin\Inventario\Create;
use App\Livewire\Admin\Inventario\Edit;
use App\Livewire\Admin\Inventario\Index;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componente livewire admin inventario index se puede renderizar', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST01',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Index::class)
        ->assertStatus(200);
});

test('ruta de inventario index carga la vista admin.inventario.index', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST02',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('inventario.index'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.inventario.index');
});

test('ruta de inventario create carga la vista admin.inventario.create', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST03',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('inventario.create'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.inventario.create');
});

test('componentes livewire admin inventario create y edit se pueden instanciar', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST04',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Create::class)
        ->assertStatus(200);

    $inventory = Inventory::create([
        'ni' => 'INV-001',
        'marca' => 'Dell',
        'modelo' => 'Optiplex',
        'tipo_id' => 'Desktop',
    ]);

    Livewire::test(Edit::class, ['id' => $inventory->id])
        ->assertStatus(200);
});

test('rutas de user-inv y responsables cargan las vistas correspondientes', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST05',
        'tipo' => 1,
    ]);

    $responseUserInv = $this->actingAs($user)->get(route('inventory.user-inv'));
    $responseUserInv->assertStatus(200);
    $responseUserInv->assertViewIs('admin.inventario.user-inv');

    $responseResp = $this->actingAs($user)->get(route('inventory.responsables'));
    $responseResp->assertStatus(200);
    $responseResp->assertViewIs('admin.inventario.responsables');
});
