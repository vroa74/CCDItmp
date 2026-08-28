<?php

namespace App\Livewire\Admin\Catalogo;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.admin.catalogo.index');
    }
}
