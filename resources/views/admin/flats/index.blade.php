@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end my-5 px-5 ">
                <a href="{{ route('admin.flats.create') }}" class=" btn-primary-cs  text-white "><strong
                        class="h6">Aggiungi appartamento</strong></a>
                <div class="offset-1"></div>
            </div>
            <div class="col-12 wrapper d-flex flex-wrap justify-content-center">
                @forelse ($flats as $flat)
                    <div class="card m-2 p-2 shadow" style="width: 20rem;">
                        <a href="{{ Route('admin.flats.show', $flat->id) }}">
                            <img src="{{ asset('storage/' .$flat->image) }}" style="height: 15rem;" class="card-img-top {{ !$flat->visible ? 'opacity-25' : '' }}"
                                alt="...">

                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $flat->title }}</h5>

                            <form action="{{ route('admin.flats.toggle', $flat) }}" method="POST" class="m-0 d-flex justify-content-between">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-outline d-flex align-items-center px-0" type='submit'>
                                    <i
                                        class="fa-xl fa-solid fa-toggle-{{ $flat->visible ? 'on' : 'off' }} text-{{ $flat->visible ? 'success' : 'danger' }} "></i>
                                    <h5 class="m-0 mx-2">{{ $flat->visible ? 'Visibile' : 'Non visibile' }}</h5>
                                </button>
                                <i class="fa-regular fa-xl fa-envelope mt-3"></i>

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
