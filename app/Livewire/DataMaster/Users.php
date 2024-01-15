<?php

namespace App\Livewire\DataMaster;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_user;

    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $mySelected = [];
    public $selectAll = false;
    public $firstId = NULL;
    public $lastId = NULL;

    #[Url()]
    public $search = '';

    #[Rule('required')]
    public $jk = 'L';
    #[Rule('required|min:3|string')]
    public $password;
    #[Rule('required|unique:users,username,id_user')]
    public $username;
    #[Rule('required')]
    public $name;

    public function sortBy($sortField)
    {
        if ($this->sortField === $sortField) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $sortField;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    // ========== delete ==============
    public function hapusUser($id)
    {
        $this->id_user = $id;
        $data = User::where('id', $this->id_user)->first();

        $this->name = $data->name;

        $this->dispatch('show-delete-modal');
    }

    public function actionHapusUser()
    {
        User::where('id', $this->id_user)->delete();

        $this->id_user = '';
        $this->name = '';

        $this->dispatch('close-delete-modal');
        $this->dispatch('delete', [
            'title' => 'Data Berhasil dihapus!',
            'icon' => 'success',
        ]);
    }

    public function closeHapus()
    {
        $this->id_user = '';
        $this->name = '';
        $this->password = '';
    }

    // ================ Bulk =======================
    public function resetSelected()
    {
        $this->mySelected = [];
        $this->selectAll = false;
    }

    public function updatedMySelected()
    {
        // dd($value);
        $data = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->orWhere('jk', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        if (count($this->mySelected) == $data->count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($this->selectAll == true) {
            $this->mySelected = User::whereBetween('id', [$this->firstId, $this->lastId])->pluck('id');
        } else {
            $this->mySelected = [];
        }
    }

    public function bulkDelete()
    {
        $mySelected = User::whereIn('id', $this->mySelected)->pluck('id');

        $this->mySelected = $mySelected;

        $this->dispatch('show-delete-bulk-modal');
    }

    public function actionBulkDelete()
    {
        User::whereIn('id', $this->mySelected)->delete();
        $this->mySelected = [];
        $this->selectAll = false;

        $this->dispatch('hide-delete-bulk-modal');
        $this->dispatch('delete', [
            'title' => 'Data Berhasil di hapus!',
            'icon' => 'success',
        ]);
    }

    public function closeBulkDelete()
    {
        $this->mySelected = [];
        $this->selectAll = false;
    }

    // =========== reset password ==========
    public function resetPassword($id)
    {
        $this->id_user = $id;
        $data = User::where('id', $this->id_user)->first();

        $this->name = $data->name;

        $this->dispatch('show-reset-password');
    }

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

    public function actionResetPassword()
    {
        $this->validate([
            'password' => 'required'
        ]);

        User::where('id', $this->id_user)->update([
            'password' => Hash::make($this->password)
        ]);

        $this->id_user = '';
        $this->name = '';
        $this->password = '';
        $this->resetValidation();

        $this->dispatch('hide-reset-password');
        $this->dispatch('reset', [
            'title' => 'Data Berhasil di ubah!',
            'icon' => 'success',
        ]);
    }

    public function closeResetPassword()
    {
        $this->id_user = '';
        $this->name = '';
        $this->password = '';
        $this->resetValidation();
    }

    // ============= ubah user ================
    public function ubahUser($id)
    {
        $this->id_user = $id;

        $data = User::where('id', $this->id_user)->first();
        $this->username = $data->username;
        $this->name = $data->name;
        $this->jk = $data->jk;

        $this->dispatch('show-edit-modal');
    }

    public function actionUbahUser()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $this->id_user,
            'jk' => 'required',
        ]);
        User::where('id', $this->id_user)->update([
            'name' => $this->name,
            'username' => $this->username,
            'jk' => $this->jk,
        ]);

        $this->id_user = '';
        $this->username = '';
        $this->name = '';
        $this->jk = '';
        $this->resetValidation();

        $this->dispatch('hide-edit-modal');
        $this->dispatch('edit', [
            'title' => 'Data Berhasil di ubah!',
            'icon' => 'success',
        ]);
    }

    public function closeEditUser()
    {
        $this->id_user = '';
        $this->username = '';
        $this->name = '';
        $this->jk = '';
        $this->resetValidation();
    }

    #[Title('Daftar User')]
    #[Layout('layouts.app')]
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->orWhere('jk', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $data = $users->count();
        if ($data > 0) {
            $this->firstId = $users[$data - 1]->id;
            $this->lastId = $users[0]->id;
        }

        return view('livewire.data-master.users', [
            'users' => $users,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
