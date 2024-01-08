<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required')]
    public $username;
    #[Rule('required|min:3')]
    public $password;

    public $showpassword = false;

    public function openPas()
    {
        $this->showpassword = !$this->showpassword;
    }

    public function loginAction()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            if (Auth::user()->active == 1) {
                return dd("berhasil login");
            } else {
                return dd("akun dibekukan");
            }
        } else {
            return dd("Username atau password salah");
        }
    }

    #[Title('Login')]
    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
