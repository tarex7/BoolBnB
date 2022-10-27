@extends('layouts.app')

<div class="container-fluid">


    @section('content')
        <div class="bg-admin-flats-homepage py-5">
            <header class="mb-5">
                <h1 class="text-center mb-3 text-uppercase text-danger">Creazione appartamento</h1>

            </header>


            @include('includes.admin.flats.form')
        </div>
    @endsection

</div>
