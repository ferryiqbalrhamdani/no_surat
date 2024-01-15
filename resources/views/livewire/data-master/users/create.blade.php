<div>
    <h1 class="mt-4">Tambah User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/users" class="text-dark" style="text-decoration: none;"><i
                    class="fas fa-solid fa-users"></i> Daftar User</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-solid fa-plus"></i> Tambah User</li>
    </ol>
    <form wire:submit.prevent='tambahUser'>
        <div class="mt-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" wire:model.live='name'
                                    class="form-control card-hover @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
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
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="text" wire:model.live='password' class="form-control card-hover"
                                        aria-describedby="button-addon2">
                                    <button wire:click="random_string" wire:loading.attr="disabled"
                                        class="btn btn-outline-secondary card-hover" type="button" id="button-addon2"><i
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
            </div>
        </div>
        <div class="gap-2">
            <a href="/users" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-dark" wire:loading.attr="disabled">
                <span wire:loading.remove> <i class="fa-regular fa-floppy-disk"></i> Simpan </span>
                <span wire:loading><i class="fa-solid fa-rotate-left fa-spin fa-spin-reverse"></i> Simpan..</span>
            </button>
        </div>
    </form>

</div>