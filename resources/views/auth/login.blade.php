@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body px-5">
                    <h4 class="my-3">
                        {{ __('Login') }}
                    </h4>
                    <p class="mb-4">Silahkan Login untuk masuk ke member</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email')
                                }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Masukan email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="col-form-label text-md-end">{{ __('Password')
                                    }}</label>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                    <small> {{ __('Lupa Password?') }}</small>
                                </a>
                                @endif
                            </div>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary d-grid w-100">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                        <p class="text-center mt-5">
                            <span>Belum Punya Akun?</span>
                            <a href="{{url('register')}}">
                                <span>Daftar Akun Baru</span>
                            </a>
                        </p>
                    </form>

                    {{-- <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a type="button" class="btn rounded-pill btn-label-pinterest"> <i class='bx bxl-google'></i>
                            Register With Google </a>

                    </div> --}}
                </div>



            </div>
        </div>
    </div>


</div>
@endsection