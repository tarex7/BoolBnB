@extends('layouts.app')

@section('content')
    <style>
        .bg-img {
            background-image: url("/images/stanza.jpg");
        }

        .bg-format {
            background-size: cover;
            background-repeat: no-repeat;
            background-position-y: center;
            height: 100vh;
        }
    </style>
    <div class="bg-img bg-format">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7  col-sm-8 col-9">
                    <div class="card" style="margin-top: 15vh">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail ') }}</label>

                                    <div class="col-md-6 col-sm-10 col-11">
                                        <input id="email" type="email" placeholder="pippo@pippo.com"
                                            class="form-control my-4 @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6 col-sm-10 col-11">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check my-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label " for="remember">
                                                {{ __('Ricordami') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4 d-flex justify-content-between">

                                        @if (Route::has('password.request'))
                                            <a class="" href="{{ route('password.request') }}">
                                                {{ __('Hai dimenticato la tua password?') }}
                                            </a>

                                            <button type="submit" class="btn btn-primary-cs">
                                                {{ __('Entra') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
