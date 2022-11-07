@extends('layouts.app')

@section('content')

    @if (count($flats) === 0)
        <div class="my-5 bg-img">
            <div class="col-12 d-flex justify-content-center  ">
                <div class="d-flex alignitems-center">
                    <h3 class="me-3">Clicca sul pulsante per aggiungere un nuovo appartamento!</h3>
                    <a href="{{ route('admin.flats.create') }}" class=" btn-primary-cs  text-white "><strong
                            class="h6">Aggiungi appartamento</strong></a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-img-2">
    @endif
    <div class="container">
        <div class="row d-flex  justify-content-center">
            @if (count($flats) > 0)
                <div class="col-12  d-flex justify-content-center my-5  ">
                    <a href="{{ route('admin.flats.create') }}" class=" btn-primary-cs  text-white "><strong
                            class="h6">Aggiungi appartamento</strong></a>
                </div>
            @endif

            @foreach ($flats as $flat)
                <div class="card m-2 p-0 rounded" style="width: 18rem;">
                    <a href="{{ Route('admin.flats.show', $flat->id) }}">
                    <img src="{{ $flat->image ? asset('storage/' . $flat->image) : asset('images/placeholder.png') }}"
                        class="card-img-top rounded-0" alt="..."> </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $flat->title }}</h5>

                        <p class="card-text">{{ $flat->address }}</p>
                        <form action="{{ route('admin.flats.toggle', $flat) }}" method="POST"
                            class="m-0 d-flex justify-content-between">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline d-flex align-items-center px-0" type='submit'>
                                <i
                                    class="fa-xl fa-solid fa-toggle-{{ $flat->visible ? 'on' : 'off' }} text-{{ $flat->visible ? 'success' : 'danger' }} "></i>
                                <h5 class="m-0 mx-2">{{ $flat->visible ? 'Visibile' : 'Non visibile' }}</h5>
                            </button>
                            {{-- <i class="fa-regular fa-xl fa-envelope mt-3"></i> --}}

                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    </div>
@endsection
