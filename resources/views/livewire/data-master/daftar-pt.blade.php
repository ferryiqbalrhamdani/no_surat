<div class="container-fluid px-4">
    @include('livewire.modal.data-master.daftar-pt-modal')
    <h1 class="mt-4">Daftar PT</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar PT</li>
    </ol>
    <div class="row">
        <div class="col-12 col-lg-3 col-md-6 mb-3">
            <button type="button" class="btn btn-lg btn-dark form-control" data-bs-toggle="modal"
                data-bs-target="#tambahData"><i class="fas fa-solid fa-plus"></i> Tambah
                Data</button>
        </div>
    </div>
    {{-- table --}}
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Table PT
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover shadow-sm" style="white-space: nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            Nama
                                            <span wire:click="sortBy('name')" style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'name' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'name' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Kode
                                            <span wire:click="sortBy('kode')" style="cursor: pointer; font-size: 10px">
                                                <i
                                                    class="fa fa-arrow-up {{$sortField === 'kode' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                                <i
                                                    class="fa fa-arrow-down {{$sortField === 'kode' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
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
                                    @if ($dataPT->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data.</td>
                                    </tr>
                                    @else

                                    @foreach ($dataPT as $dp)
                                    <tr class="">
                                        <td scope="row">
                                            {{$dp->name}}
                                        </td>
                                        <td>
                                            {{$dp->kode}}
                                        </td>
                                        <td>
                                            {{date_format($dp->created_at, 'd/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger" wire:click='hapusPT({{$dp->id}})'
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Hapus data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" wire:click='ubahPT({{$dp->id}})'
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Ubah data">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <span>Halaman : {{ $dataPT->currentPage() }} </span><br />
                                <span>Jumlah Data : @if($search == '') {{$dataPT->total()}} @else
                                    {{$dataPT->count() }}
                                    @endif</span><br />
                                <span>Data Per Halaman : {{ $dataPT->perPage()}} </span><br /><br />
                            </div>
                            <div class="col-12 col-lg-4 d-flex justify-content-end">
                                {{$dataPT->links()}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir table --}}
</div>