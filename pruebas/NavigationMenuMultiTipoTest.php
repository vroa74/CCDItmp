<?php

use App\Livewire\NavigationMenuA;
use App\Livewire\NavigationMenuG;
use App\Livewire\NavigationMenuT;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('componentes de navegacion se renderizan correctamente segun tipo de usuario', function () {
    $admin = User::factory()->create(['curp' => 'TEST123456NAV001', 'tipo' => 1]);
    $tecnico = User::factory()->create(['curp' => 'TEST123456NAV002', 'tipo' => 2]);
    $general = User::factory()->create(['curp' => 'TEST123456NAV003', 'tipo' => 3]);

    $this->actingAs($admin);
    Livewire::test(NavigationMenuA::class)->assertStatus(200);
    $responseAdmin = $this->get('/dashboard');
    $responseAdmin->assertStatus(200);
    $responseAdmin->assertSeeLivewire(NavigationMenuA::class);

    $this->actingAs($tecnico);
    Livewire::test(NavigationMenuT::class)->assertStatus(200);
    $responseTecnico = $this->get('/dashboard');
    $responseTecnico->assertStatus(200);
    $responseTecnico->assertSeeLivewire(NavigationMenuT::class);

    $this->actingAs($general);
    Livewire::test(NavigationMenuG::class)->assertStatus(200);
    $responseGeneral = $this->get('/dashboard');
    $responseGeneral->assertStatus(200);
    $responseGeneral->assertSeeLivewire(NavigationMenuG::class);
});
