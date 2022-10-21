@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    <h1>I tuoi appartamenti</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="" class="btn btn-primary text-white"><h4>Aggiungi appartamento</h4></a>
                </div>
            </div>
            <div class="col-12 wrapper d-flex flex-wrap">
                @forelse ($flats as $flat)
               <a href="{{ Route('') }}"></a>
                @empty
                    <tr>
                        <td colspan="8">
                            <h3 class="text-center">Nessun Appartamento</h3>
                        </td>
                    </tr>
                @endforelse
            </div>
        </div>
    </div>

@endsection
 

         
