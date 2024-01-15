<?php

namespace App\Livewire\DataMaster\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Create extends Component
{
    #[Rule('required')]
    public $jk = 'L';
    #[Rule('required|min:3|string')]
    public $password;
    #[Rule('required|unique:users,username')]
    public $username;
    #[Rule('required')]
    public $name;

    public function random_string($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $this->password = '';
        for ($i = 0; $i < $length; $i++) {
            $this->password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $this->password;
    }

    public function tambahUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'jk' => $this->jk,
        ]);

        Alert::toast('Data user berhasil ditambah!', 'success');
        return redirect('users');
    }

    #[Title('Tambah User')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.data-master.users.create');
    }
}
