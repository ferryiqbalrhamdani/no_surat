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

<div wire:ignore.self class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Hapus Data User</h1>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p class="text-center">Apakah anda yakin ingin menhapus data <b>{{$name}}</b>?</p>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"
                    wire:click='closeHapus'>Kembali</button>
                <button wire:click='actionHapusUser' class="btn btn-danger"><i class="fas fa-solid fa-trash"></i>
                    Iya! Hapus</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="reset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Reset Password {{$name}}</h1>
            </div>
            <form wire:submit.model='actionResetPassword'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group card-hover">
                                    <input type="text" wire:model.live='password'
                                        class="form-control  @error('password') is-invalid @enderror"
                                        aria-describedby="button-addon2">
                                    <button wire:click="random_string" wire:loading.attr="disabled"
                                        class="btn btn-outline-secondary" type="button" id="button-addon2"><i
                                            class="fa-solid fa-rotate-left"></i>
                                        <div wire:loading wire.target="random_string">
                                            Processing ...
                                        </div>
                                    </button>
                                </div>
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"
                        wire:click='closeResetPassword'>Kembali</button>
                    <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Ubah Data User</h1>
            </div>
            <form wire:submit.model='actionUbahUser'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input wire:model.live='username' type="text" id="username"
                                    class="form-control card-hover @error('username') is-invalid @enderror">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="L" type="radio" wire:model.live='jk'
                                                id="L">
                                            <label class="form-check-label" for="L">
                                                Laki-laki
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="P" type="radio" wire:model.live='jk'
                                                id="P">
                                            <label class="form-check-label" for="P">
                                                Perempuan
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                @error('jk')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" wire:model.live='name'
                                    class="form-control card-hover @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"
                        wire:click='closeEditUser'>Kembali</button>
                    <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('users')
<script>
    // reset password
    window.addEventListener('show-edit-modal', event =>{
        $('#edit').modal('show');
    });
    window.addEventListener('hide-edit-modal', event =>{
        $('#edit').modal('hide');
    });
    document.addEventListener('livewire:initialized', () =>{
        @this.on('edit',(event) => {
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

    // reset password
    window.addEventListener('show-reset-password', event =>{
        $('#reset').modal('show');
    });
    window.addEventListener('hide-reset-password', event =>{
        $('#reset').modal('hide');
    });
    document.addEventListener('livewire:initialized', () =>{
        @this.on('reset',(event) => {
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

    // bulk delete
    window.addEventListener('show-delete-bulk-modal', event =>{
        $('#bulkHapus').modal('show');
    });
    window.addEventListener('hide-delete-bulk-modal', event =>{
        $('#bulkHapus').modal('hide');
    });
    $(".page-item").on('click', function(event) {
        Livewire.dispatch('resetMySelected');
    });
</script>
@endpush