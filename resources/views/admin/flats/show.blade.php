@extends('layouts.app')


@section('content')
    <div class="container-fluid">


        <div class="row">

          <div class="col-12">
            <div class="d-flex justify-content-end my-5">
              @if ($flat->user_id === Auth::id())
                        <a href="{{ route('admin.flats.edit', $flat->id) }}" class="btn  btn-warning "><strong
                                class="h4">Modifica </strong></a>
                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-light  mx-3"> <strong class="h4">Elimina
                                </strong></button>
                        </form>
                    @endif
                    <a href="{{ route('admin.flats.index') }}" class="btn btn-primary text-white"><strong
                            class="h4">Torna alla lista </strong></a>
                </div>
            </div>

            <div class="offset-2"></div>

            <div class="col-4">
                <div class="card p-4">
                    <h2>{{ $flat->title }}</h2>
                    {{-- <img src="{{ asset('storage/' .$flat->image) }}" alt=""> --}}
                    <img src="{{ $flat->image }}" alt="">

                    <p class="h4 my-4 py-2 w-75">{{ $flat->address }}</p>
                    <div class="info d-flex mt-4 border align-items-center my-2 p-3">
                        <p class=" mb-0">{{ $flat->square_mt }} m<sup>2</sup></p>
                        <p class="mx-3 mb-0"> {{ $flat->bed_number }} letti</p>
                        <p class="mx-3 mb-0"> {{ $flat->room_number }} stanze</p>
                        <p class="mx-3 mb-0"> {{ $flat->bathroom_number }} bagni</p>
                    </div>

                    <div class="d-flex justify-content-between mt-1 border py-2">
                        <p class="mx-3 fw-bolder h5 mt-2 mb-0">Prezzo per notte</p><strong
                            class="h3 m-0 ms-2 text-danger mx-3 ">{{ $flat->price_per_day }} €</strong>
                    </div>

                    <div class="border my-3"></div>

                    <div class="col-12">
                        <h2 class="mt-3">Descrizione</h2>
                        <p class="mt-2 text-justify">{{ $flat->description }}</p>
                    </div>
                    @if (count($flat->services))
                        <div class="border my-3"></div>
                    @endif

                    <div class="col-12">
                        @if (count($flat->services))
                            <h2 class="mt-3">Servizi</h2>
                        @endif
                        <div class="d-flex justify-content-between flex-wrap">

                            @foreach ($flat->services as $service)
                                <p class="mt-2 me-5 w-75"><i class="{{ $service->icon }} fa-2x"></i> {{ $service->label }}
                                </p>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-5">

                <div class="card p-3">
                    <h2 class="mb-3">Statistiche</h2>
                    @include('includes.admin.chart')

                    <div class="mt-5">
                        <h2 class="mb-3">Posizione</h2>
                        @include('includes.map')
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="border my-3"></div>



            </div>

        </div>

    </div>
@endsection
