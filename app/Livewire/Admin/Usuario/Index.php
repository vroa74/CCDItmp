<?php

namespace App\Livewire\Admin\Usuario;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();

        return view('livewire.admin.usuario.index', [
            'user' => $user,
        ]);
    }
}
