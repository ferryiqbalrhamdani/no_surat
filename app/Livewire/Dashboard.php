<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.dashboard');
    }
}
