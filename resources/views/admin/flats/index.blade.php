@include('includes.header')
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
            <div class="col-12 d-flex justify-content-end my-4 px-3">
                <a href="{{ route('admin.flats.create') }}" class="btn btn-primary me-3 text-white "><strong class="h4">Aggiungi un appartamento</strong></a>
            </div>
            <div class="col-12 wrapper d-flex flex-wrap justify-content-center">
                @forelse ($flats as $flat)
                    <div class="card m-3 p-3" style="width: 18rem;">
                        <a href="{{ Route('admin.flats.show', $flat->id) }}">
                            <img src="{{ $flat->image }}" class="card-img-top {{ !$flat->visible ? 'opacity-25' : "" }}" alt="...">
                            
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $flat->title }}</h5>

                            <form action="{{ route('admin.flats.toggle', $flat) }}" method="POST" class="m-0">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-outline d-flex align-items-center px-0" type='submit'>
                                    <i class="fa-2x fa-solid fa-toggle-{{ $flat->visible ? 'on' : 'off' }} text-{{ $flat->visible ? 'success' : 'danger' }} "></i>
                                    <h6 class="m-0 mx-2">{{ $flat->visible ? 'Visibile' : 'Non visibile' }}</h6>
                                </button>
                            </form>
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
