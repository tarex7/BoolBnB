@extends('layouts.app')

@section('content')
    <style>
        .bg-img {
            background-image: url("/images/sea.jpg");
        }

        .bg-format {
            background-size: cover;
            background-repeat: no-repeat;
            background-position-y: center;
            height: 100vh;
        }
        @media only screen and (max-width: 576px) {
            .card{
                margin: 50px
            }
        }
        @media only screen and (min-width: 768px) {
            .row {
                margin-bottom: 1rem;
            }
            #password-confirm{
                margin-top: 10px;
            }
        }
        @media only screen and (min-width: 992px) {
            .row {
                margin-bottom: 1rem;
            }
            #password-confirm{
                margin-top: 0;
            }
        }
    </style>

    <div class="bg-img bg-format">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-10 mt-5">
                    <div class="card">
                        <div class="card-header">{{ __('Registrati') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class=" row">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Nickname*') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="name" type="text" placeholder="pippo"
                                            class="form-control @error('name') is-invalid @enderror" name="name" required
                                            value="{{ old('name') }}" autocomplete="name" autofocus minlength="3"
                                            maxlength="255">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="first_name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="first_name" type="text" placeholder="goofy"
                                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                            value="{{ old('first_name') }}" autocomplete="first_name" autofocus
                                            minlength="3" maxlength="255">

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="last_name" 
                                        class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="last_name" type="text" placeholder="disney"
                                            class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                            value="{{ old('last_name') }}" autocomplete="last_name" autofocus minlength="3"
                                            maxlength="255">

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo email*') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="email" type="email" placeholder="pippo@pippo.com"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            required value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class=" row">
                                    <label for="date_of_birth"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                                    <div class="col-md-6 col-10">
                                        <input id="date_of_birth" type="date" class="form-control" name="date_of_birth"
                                            min='1920-01-01' max="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>

                                <div class=" row mt-3">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary text-white">
                                            {{ __('Registrati') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let password = document.getElementById("password");
        let passwordConfirm = document.getElementById("password-confirm");

        function validatePassword() {
            if (password.value != passwordConfirm.value) {
                passwordConfirm.setCustomValidity("La password non coincide");
            } else {
                passwordConfirm.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        passwordConfirm.onkeyup = validatePassword;
    </script>
@endsection
