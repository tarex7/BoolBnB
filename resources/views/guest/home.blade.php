@extends('layouts.app')
@section('vue')
<script src="{{ asset('js/front.js') }}" defer></script>

@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    

    <body>
        <div class="content">

            {{-- CONTENUTO GESTITO DA VUE --}}
            <div id="root">


            </div>

        </div>

    </body>

    </html>
@endsection
