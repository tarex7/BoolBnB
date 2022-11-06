@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <header>
            <h3 class="text-center my-3">Crea appartamento</h3>
        </header>

        @include('includes.admin.flats.form')
        @include('includes.footer')
    </div>
@endsection
