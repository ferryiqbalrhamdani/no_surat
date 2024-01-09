<?php

namespace App\Livewire\DataMaster;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Users extends Component
{
    #[Title('Daftar User')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.data-master.users');
    }
}
