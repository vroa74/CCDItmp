<?php

use App\Livewire\Admin\Servicios\Create;
use App\Livewire\Admin\Servicios\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componentes livewire admin servicios se pueden renderizar', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST10',
        'tipo' => 1,
    ]);

    $this->actingAs($user);

    Livewire::test(Index::class)
        ->assertStatus(200);

    Livewire::test(Create::class)
        ->assertStatus(200);
});

test('ruta servicios index carga la vista admin.servicios.index', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST11',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('servicios.index'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.servicios.index');
    $response->assertSeeLivewire(Index::class);
});

test('ruta servicios create carga la vista admin.servicios.create', function () {
    $user = User::factory()->create([
        'curp' => 'TEST123456TEST12',
        'tipo' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('servicios.create'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.servicios.create');
    $response->assertSeeLivewire(Create::class);
});
