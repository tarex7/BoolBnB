@include('includes.header')
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 wrapper d-flex flex-wrap">
                @forelse ($flats as $flat)
                <div class="card m-3 p-3" style="width: 18rem;">
                    <a href="{{ Route('admin.flats.show', $flat->id) }}">
                        <img src="{{ $flat->image }}" class="card-img-top" alt="...">
                    </a>
                        <div class="card-body">
                          <h5 class="card-title">{{ $flat->title }}</h5>
                          <p class="card-text"><strong>{{ $flat->price_per_day }} € </strong>notte</p>
                        </div>
                      </div>

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
 

         
