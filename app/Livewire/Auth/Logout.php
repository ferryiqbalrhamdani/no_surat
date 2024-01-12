<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        Alert::toast('Berhasil logout', 'success');
        return redirect('login');
    }


    public function render()
    {
        return view('livewire.auth.logout');
    }
}
