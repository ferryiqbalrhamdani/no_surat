<?php

namespace App\Livewire\DataMaster;

use App\Models\ModelPT;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class DaftarPt extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_pt;

    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    #[Url()]
    public $search = '';

    #[Rule('required|string', as: 'Nama PT')]
    public $name = '';
    #[Rule('required|string')]
    public $kode;

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

    public function addPT()
    {
        $this->validate();
        ModelPT::create([
            'name' => $this->name,
            'kode' => $this->kode,
        ]);

        Alert::toast('Data berhasil ditambah.', 'success');
        return redirect('daftar-pt');
    }

    #[Title('Daftar PT')]
    #[Layout('layouts.app')]
    public function render()
    {
        $dataPT = ModelPT::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('kode', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.data-master.daftar-pt', [
            'dataPT' => $dataPT
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
