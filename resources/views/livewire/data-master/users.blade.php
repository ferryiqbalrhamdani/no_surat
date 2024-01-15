<div>
    @include('livewire.modal.data-master.users-modal')
    <style>
        .table-selected:hover {
            color: #d81111;
        }
    </style>
    <h1 class="mt-4">Daftar User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><i class="fas fa-solid fa-users"></i> Daftar User</li>
    </ol>
    <div class="row">
        <div class="col-12 col-lg-3 col-md-6 mb-3">
            <button onclick="linkAddUser()" class="btn btn-lg btn-dark form-control" data-bs-toggle="modal"
                data-bs-target="#tambahData"><i class="fas fa-solid fa-plus"></i> Tambah
                Data
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Table User
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="mb-3 mt-1">
                                    Show <select class=" card-hover" aria-label="Small select example"
                                        wire:model.live='perPage'>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select> entries
                                </div>
                            </div>
                            <div class="col-12 col-lg-6"></div>
                            <div class="col-12 col-lg-3">
                                <div class="mb-3 shadow-sm ">
                                    <input type="text" class="form-control card-hover" placeholder="Cari data"
                                        wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        @if ($mySelected!=NULL)
                        <div class="mb-3">
                            <button wire:click='bulkDelete' class="btn btn-outline-danger"><i
                                    class="fas fa-regular fa-trash-can"></i>
                                Hapus</button>
                        </div>
                        @endif
                        {{-- table --}}
                        {{-- {{var_dump($mySelected)}} --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover shadow-sm" style="white-space: nowrap">
                                @if ($mySelected!=NULL)
                                <thead class="table-secondary">
                                    <tr>
                                        <td colspan="6">
                                            <span>{{count($mySelected)}} data dipilih</span>
                                        </td>
                                    </tr>
                                </thead>
                                @endif
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" wire:model.live='selectAll'>
                                            <input type="text" hidden wire:model.live='firstId' value="
                                                            @if($users->count() > 0) 
                                                                {{$users[0]->id}} 
                                                            @endif
                                                        ">
                                        </th>
                                        <th>
                                            Nama
                                            <span wire:click="sortBy('name')" style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'name' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'name' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Username
                                            <span wire:click="sortBy('username')"
                                                style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'username' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'username' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Jenis Kelamin
                                            <span wire:click="sortBy('jk')" style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'jk' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'jk' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Tgl Input
                                            <span wire:click="sortBy('created_at')"
                                                style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data.</td>
                                    </tr>
                                    @else

                                    @foreach ($users as $u)
                                    <tr>
                                        <td scope="row" class="text-center">
                                            <input class="form-check-input" type="checkbox" value="{{$u->id}}"
                                                wire:model.live='mySelected'>
                                        </td>
                                        <td>
                                            {{$u->name}}
                                        </td>
                                        <td>
                                            {{$u->username}}
                                        </td>
                                        <td>
                                            {{$u->jk }}
                                        </td>
                                        <td>
                                            {{date_format($u->created_at, 'd/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger" wire:click='hapusUser({{$u->id}})'
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" wire:click='ubahUser({{$u->id}})'
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-title="Ubah data">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary"
                                                wire:click='resetPassword({{$u->id}})' data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Reset password">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        {{-- akhir table --}}
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <span>Halaman : {{ $users->currentPage() }} </span><br />
                                <span>Jumlah Data : @if($search == '') {{$users->total()}} @else
                                    {{$users->count() }}
                                    @endif</span><br />
                                <span>Data Per Halaman : {{ $users->perPage()}} </span><br /><br />
                            </div>
                            <div class="col-12 col-lg-4 d-flex justify-content-end">
                                {{$users->links()}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function linkAddUser() {
          location.href = "/users/create";
        }
    </script>
</div>