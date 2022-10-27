@extends('layouts.app')



@section('content')
    <div class="bg-admin-flats-homepage py-5">
        <header class="mb-5">
            <h1 class="text-center mb-3 text-uppercase text-danger fw-bold">Modifica l'appartamento</h1>
        </header>
        @include('includes.admin.flats.form')
    </div>
@endsection
