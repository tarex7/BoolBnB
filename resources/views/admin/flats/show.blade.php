@extends('layouts.app')


@section('content')
    <section class="admin-flatdetail mt-5">
        <div class="container">


            <div class="row">

                <div class="col-6">
                    <div class="card p-4">
                        <h1 class="text-danger mb-3 fw-bold">{{ $flat->title }}</h1>

                        {{-- IMAGE --}}
                        <img class="float-left mr-2" width="580" src="{{ asset('storage/' . $flat->image) }}"
                            alt="{{ $flat->title }}">


                        <hr>
                        {{-- BUTTON --}}
                        <div class="col">
                            <div class="d-flex justify-content-between  my-3">

                                <div> <a href="{{ route('admin.flats.index') }}" class="btn btn-primary text-white"><strong
                                            class="h5">Torna alla lista </strong></a>

                                </div>
                                <div class="d-flex">
                                    @if ($flat->user_id === Auth::id())
                                        <a href="{{ route('admin.flats.edit', $flat->id) }}"
                                            class="btn  btn-warning "><strong class="h5">Modifica </strong></a>
                                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger text-light  mx-3"> <strong class="h5">Elimina
                                                </strong></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr>
                        {{-- INDIRIZZO --}}
                        <h3 class="mt-3 fw-bold">Indirizzo</h3>
                        <p class="h4 my-4 py-1 w-75">
                            <i class="fa-solid fa-location-dot me-2"></i>{{ $flat->address }}
                        </p>
                        <hr>

                        <h3 class="mt-3 fw-bold">Informazioni Generali</h3>
                        <div class="info d-flex mt-4 border justify-content-around my-2 p-3 text-muted fw-bold">
                            <p class=" mb-0">{{ $flat->square_mt }} m<sup>2</sup></p>
                            <p class="mx-3 mb-0"> {{ $flat->bed_number }} letti</p>
                            <p class="mx-3 mb-0"> {{ $flat->room_number }} stanze</p>
                            <p class="mx-3 mb-0"> {{ $flat->bathroom_number }} bagni</p>
                        </div>

                        <div class="d-flex justify-content-between mt-1 border py-2 mb-2">
                            <p class="mx-3 fw-bolder h5 mt-2 mb-0">Prezzo per notte</p><strong
                                class="h3 m-0 ms-2 text-danger mx-3 ">{{ $flat->price_per_day }} €</strong>
                        </div>

                        <div class="border my-3"></div>

                        <div class="col-12">
                            <h3 class="mt-3 fw-bold ">Descrizione</h3>
                            <p class="mt-2 text-justify text-muted">{{ $flat->description }}</p>
                        </div>
                        @if (count($flat->services))
                            <div class="border my-3"></div>
                        @endif

                        <div class="col-12">
                            @if (count($flat->services))
                                <h3 class="my-3 fw-bold">Servizi</h3>
                            @endif
                            <div class="row justify-contet-between">

                                @foreach ($flat->services as $service)
                                    <div class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="mt-1 me-3"><i class="{{ $service->icon }} text-danger fa-2x"></i>
                                            <h6 class="text-muted text-jutisfy"> {{ $service->label }}</h6>

                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-6">

                    <div class="card p-3">
                        <h3 class="mt-3 fw-bold ">Statistiche</h3>
                        @include('includes.admin.chart')

                        <div class="mt-5">
                            <h3 class="mt-3 fw-bold ">Posizione</h3>
                            @include('includes.map')


                        </div>

                    </div>

                </div>
                <div class="col-12">
                    <div class="border my-3"></div>



                </div>

            </div>

        </div>
    </section>
@endsection
