<?php

namespace App\Livewire\Admin\Reportes;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $currentUser = Auth::user();

        return view('livewire.admin.reportes.index', [
            'currentUser' => $currentUser,
        ]);
    }
}
