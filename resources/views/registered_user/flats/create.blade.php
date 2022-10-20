@extends('layouts.app')

<div class="container-fluid">

    @section('content')
        <header>
            <h1 class="text-center">Crea appartamento</h1>
        </header>

        @include('includes.registered_user.flats.form')
    </div>
@endsection
