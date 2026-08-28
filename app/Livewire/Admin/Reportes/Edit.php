<?php

namespace App\Livewire\Admin\Reportes;

use Livewire\Component;

class Edit extends Component
{
    public $reporteId;

    public $titulo = '';

    public $descripcion = '';

    public $tipo = 'general';

    public function mount($id = null)
    {
        $this->reporteId = $id;
    }

    public function update()
    {
        session()->flash('message', 'Reporte actualizado correctamente.');

        return redirect()->route('admin.reportes.index');
    }

    public function render()
    {
        return view('livewire.admin.reportes.edit');
    }
}
