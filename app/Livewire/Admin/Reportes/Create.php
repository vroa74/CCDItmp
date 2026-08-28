<?php

namespace App\Livewire\Admin\Reportes;

use Livewire\Component;

class Create extends Component
{
    public $titulo = '';

    public $descripcion = '';

    public $tipo = 'general';

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'tipo' => 'required|string',
    ];

    public function save()
    {
        $this->validate();
        session()->flash('message', 'Reporte creado correctamente.');

        return redirect()->route('admin.reportes.index');
    }

    public function render()
    {
        return view('livewire.admin.reportes.create');
    }
}
