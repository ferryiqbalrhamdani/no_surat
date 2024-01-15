<div wire:ignore.self class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-regular fa-building"></i>
                    Tambah Data PT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='addPT'>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" wire:model.live='name'
                                        class="form-control card-hover @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" id="kode" wire:model.live='kode'
                                        class="form-control card-hover @error('kode') is-invalid @enderror">
                                    @error('kode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-dark"><i class="fas fa-regular fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="ubahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-regular fa-building"></i>
                    Ubah Data PT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='actionUbahPT'>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" value="{{$name}}" wire:model.live='name'
                                        class="form-control card-hover @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" id="kode" wire:model.live='kode' value="{{$kode}}"
                                        class="form-control card-hover @error('kode') is-invalid @enderror">
                                    @error('kode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"
                        wire:click='closeUbah'>Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-solid fa-pen-to-square"></i>
                        Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Hapus Data PT</h1>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p>Apakah anda yakin ingin menhapus data <b>{{$name}}</b>?</p>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"
                    wire:click='closeHapus'>Kembali</button>
                <button wire:click='actionHapusPT' class="btn btn-danger"><i class="fas fa-solid fa-trash"></i>
                    Iya! Hapus</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="bulkHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Hapus Data PT</h1>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p class="text-center">Apakah anda yakin ingin menhapus data?</p>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Kembali</button>
                <button wire:click='actionBulkDelete' class="btn btn-danger"><i class="fas fa-solid fa-trash"></i>
                    Iya! Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('daftar-pt')
<script>
    // hapus
    window.addEventListener('show-delete-modal', event =>{
        $('#hapus').modal('show');
    });
    window.addEventListener('close-delete-modal', event =>{
        $('#hapus').modal('hide');
    });
    document.addEventListener('livewire:initialized', () =>{
        @this.on('delete',(event) => {
            const data=event
            swal.fire({
                toast: true,
                position: "top-end",
                icon:data[0]['icon'],
                title:data[0]['title'],
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            })
    });

    // ubah
    window.addEventListener('show-update-modal', event =>{
        $('#ubahData').modal('show');
    });
    window.addEventListener('close-update-modal', event =>{
        $('#ubahData').modal('hide');
    });
    document.addEventListener('livewire:initialized', () =>{
        @this.on('update',(event) => {
            const data=event
            swal.fire({
                toast: true,
                position: "top-end",
                icon:data[0]['icon'],
                title:data[0]['title'],
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            })
    });

    // bulk delete
    window.addEventListener('show-delete-bulk-modal', event =>{
        $('#bulkHapus').modal('show');
    });
    window.addEventListener('hide-delete-bulk-modal', event =>{
        $('#bulkHapus').modal('hide');
    });
    

    $(".page-item").on('click', function(event) {
        Livewire.dispatch('resetMySelected');
    })
</script>
@endpush