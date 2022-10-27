@extends('layouts.app')

<div class="container-fluid">

    @section('content')
        <header class="my-5">
            <h1 class="text-center mb-3 text-uppercase text-danger">Creazione appartamento</h1>
        </header>

        @include('includes.admin.flats.form')
    @endsection

</div>
