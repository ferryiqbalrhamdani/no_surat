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

    public $mySelected = [];
    public $selectAll = false;
    public $firstId = NULL;
    public $lastId = NULL;

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

    // ================= hapus ===========================
    public function hapusPT($id)
    {
        $this->id_pt = $id;
        $data = ModelPT::where('id', $this->id_pt)->first();

        $this->name = $data->name;

        $this->dispatch('show-delete-modal');
    }

    public function actionHapusPT()
    {
        ModelPT::where('id', $this->id_pt)->delete();

        $this->id_pt = '';
        $this->name = '';

        $this->dispatch('close-delete-modal');
        $this->dispatch('delete', [
            'title' => 'Data Berhasil dihapus!',
            'icon' => 'success',
        ]);
    }

    public function closeHapus()
    {
        $this->id_pt = '';
        $this->name = '';
    }

    // ================= ubah ===========================
    public function ubahPT($id)
    {
        $this->id_pt = $id;
        $data = ModelPT::where('id', $this->id_pt)->first();

        $this->name = $data->name;
        $this->kode = $data->kode;

        $this->dispatch('show-update-modal');
    }

    public function actionUbahPT()
    {
        ModelPT::where('id', $this->id_pt)->update([
            'name' => $this->name,
            'kode' => $this->kode,
        ]);

        $this->id_pt = '';
        $this->name = '';
        $this->kode = '';

        $this->dispatch('close-update-modal');
        $this->dispatch('update', [
            'title' => 'Data Berhasil diubah!',
            'icon' => 'success',
        ]);
    }

    public function closeUbah()
    {
        $this->id_pt = '';
        $this->name = '';
        $this->kode = '';
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
        $data = ModelPT::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('kode', 'like', '%' . $this->search . '%')
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
            $this->mySelected = ModelPT::whereBetween('id', [$this->firstId, $this->lastId])->pluck('id');
            // dd($this->mySelected);
        } else {
            $this->mySelected = [];
            // dd('tidak ok');
        }
    }

    public function bulkDelete()
    {
        $mySelected = ModelPT::whereIn('id', $this->mySelected)->pluck('id');

        $this->mySelected = $mySelected;

        $this->dispatch('show-delete-bulk-modal');
    }

    public function actionBulkDelete()
    {
        ModelPT::whereIn('id', $this->mySelected)->delete();
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

    #[Title('Daftar PT')]
    #[Layout('layouts.app')]
    public function render()
    {
        $dataPT = ModelPT::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('kode', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $data = $dataPT->count();
        if ($data > 0) {
            $this->firstId = $dataPT[$data - 1]->id;
            $this->lastId = $dataPT[0]->id;
        }
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
