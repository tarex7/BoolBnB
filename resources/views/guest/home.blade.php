@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BoolPress</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

       

        
      

    </head>

    <body>
        <div class="content">

            {{-- CONTENUTO GESTITO DA VUE --}}
            <div id="root">



            </div>

        </div>

    </body>

    </html>
@endsection
