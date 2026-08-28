<?php

use App\Livewire\Admin\Cartasresponsivas\Create;
use App\Livewire\Admin\Cartasresponsivas\Index;
use App\Models\Responsiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componente livewire admin cartasresponsivas index se puede renderizar', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456RESP01',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Index::class)
        ->assertStatus(200);
});

test('ruta de cartasresponsivas index carga la vista admin.cartasresponsivas.index', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456RESP02',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('cartasresponsivas.index'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.cartasresponsivas.index');
});

test('ruta de cartasresponsivas create carga la vista admin.cartasresponsivas.create', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456RESP03',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('cartasresponsivas.create'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.cartasresponsivas.create');
});

test('componente livewire admin cartasresponsivas create se puede instanciar', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456RESP04',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Create::class)
        ->assertStatus(200);
});

test('ruta de cartasresponsivas show y edit cargan las vistas correspondientes', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456RESP05',
        'tipo' => 1,
    ]);

    $responsiva = Responsiva::create([
        'codigo' => 'CR-TEST-001',
        'user_id' => $user->id,
        'responsable_id' => $user->id,
        'informatica_id' => $user->id,
        'fecha' => now(),
        'auditoria' => false,
    ]);

    $responseShow = $this->actingAs($user)->get(route('cartasresponsivas.show', $responsiva->id));
    $responseShow->assertStatus(200);
    $responseShow->assertViewIs('admin.cartasresponsivas.show');

    $responseEdit = $this->actingAs($user)->get(route('cartasresponsivas.edit', $responsiva->id));
    $responseEdit->assertStatus(200);
    $responseEdit->assertViewIs('admin.cartasresponsivas.edit');
});
