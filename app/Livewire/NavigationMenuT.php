<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class NavigationMenuT extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('navigation-menu-t');
    }
}
