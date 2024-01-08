<div>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <h3 class=" text-center">No Surat App</h3>
                            <hr class="mb-5">
                            <form wire:submit.prevent='loginAction'>

                                <div class="form-floating mb-4">
                                    <input class="form-control card-hover @error('username') is-invalid @enderror"
                                        id="username" type="text" placeholder="123456" value="{{old('username')}}"
                                        wire:model.live='username' />
                                    <label for="username">Username</label>
                                    <div>@error('username') <span class="text-danger"> {{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-floating mb-4">
                                    <input class="form-control card-hover @error('password') is-invalid @enderror"
                                        id="password" @if($showpassword==false) type="password" @else type="text" @endif
                                        placeholder="123456" value="{{old('password')}}" wire:model.live='password' />
                                    <label for="password">Password</label>
                                    <div>@error('password') <span class="text-danger"> {{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3"
                                        wire:click='openPas()' /><span style="margin-right: 10px"></span>
                                    <label class="form-check-label" for="form1Example3">Tampilkan password </label>
                                </div>

                                <button class="btn btn-dark btn-lg btn-block form-control card-hover" type="submit"><i
                                        class="fas fa-sign-in-alt"></i> MASUK</button>
                            </form>
                            <hr class="my-4">

                            <div class="d-flex justify-content-center">
                                <span class="">Belum punya akun? <a href="https://wa.me/6282373246104"
                                        target="__blank">hubungi admin</a></span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>