@extends('layouts.app')

@section('content')
    <section id="admin-index-header">
        <div class="container admin-header-content">
            <div class="row h-100 ">
                <div class="col-md-8 h-100 d-flex align-items-center">
                    <div class="row flex-column">
                        <div class="col">
                            <p><span id="greetings">

                                    <h1 class="text-success  text-uppercase  fw-bold ">{{ Auth::user()->name }}</h1>
                                </span></p>
                        </div>
                        <div>
                            <h1>Benvenuto nella tua area riservata</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-end  align-items-center">
                    <a href="{{ route('admin.flats.create') }}" class=" button-53  text-decoration-none"><strong
                            class="h5">Aggiungi
                            appartamento</strong></a>


                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <section id="admin-flats-homepage mt-5">
            <div class="bg-admin-flats-homepage">
                <div class="row">

                    <div class="col-12 wrapper d-flex flex-wrap justify-content-center mt-5">
                        {{-- ALL FLATS --}}
                        @forelse ($flats as $flat)
                            <div class="card m-3 p-2 shadow rounded-start rounded-4" style="width: 20rem;">
                                <a href="{{ Route('admin.flats.show', $flat->id) }}">
                                    <img src="{{ asset('storage/' . $flat->image) }}" style="height: 15rem;"
                                        class="card-img-top {{ !$flat->visible ? 'opacity-25' : '' }}" alt="...">

                                </a>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><strong>{{ $flat->title }}</strong></h5>
                                    <div class="h4 my-2 py-1 text-muted fs-6">
                                        <i class="fa-solid fa-location-dot me-2 d-inline"></i>
                                        <address class="d-inline">{{ $flat->address }}</address>
                                    </div>
                                    <div class="h4 my-2 py-1 fs-5">
                                        <i class="fa-regular fa-envelope d-inline"></i>
                                        <h6 class="d-inline"> Messaggi</h6>
                                    </div>

                                    <div class="h4 my-2 py-1 fs-5">
                                        <i class="fa-regular fa-eye d-inline"></i>
                                        <h6 class="d-inline"> Visite</h6>

                                    </div>


                                    {{-- VISIBILITA' --}}
                                    <form action="{{ route('admin.flats.toggle', $flat) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-outline d-flex align-items-center px-0" type='submit'>
                                            <i
                                                class="fa-2x fa-solid fa-toggle-{{ $flat->visible ? 'on' : 'off' }} text-{{ $flat->visible ? 'success' : 'danger' }} "></i>
                                            <h5
                                                class="m-0 mx-2 fw-bold fs-6     {{ $flat->visible ? 'text-success' : 'text-danger' }} ">
                                                {{ $flat->visible ? 'Visibile' : 'Non visibile' }}
                                            </h5>
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
        </section>
    </div>
@endsection


<
