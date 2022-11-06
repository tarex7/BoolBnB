@extends('layouts.app')

<style>
    @media only screen and (min-width: 300px) {
        .button {
            margin-right: 32px;
            justify-content: flex-start
        }

        .btn {
            height:40px ;
            width: 86px;
            margin: 5px;
        }
        .fix-heigt{line-height:1.5; }
        .font-sz{
            font-size: 12px;
            line-height:1.1;
        }
    }
</style>
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="d-flex button my-3">
                    @if ($flat->user_id === Auth::id())
                        <a href="{{ route('admin.flats.edit', $flat->id) }}" class="btn  btn-warning "><strong
                                class=" fix-heigt">Modifica </strong></a>
                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST" class="delete-form m-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-light"> 
                                <strong>Elimina</strong>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.flats.index') }}" class="btn btn-primary text-white"><strong
                            class="font-sz">Torna indietro </strong></a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-10 col-md-11 col-11">
                <div class="card p-4">
                    <h2>{{ $flat->title }}</h2>

                    <img class="float-left mr-2 img-fluid" 
                        src=" {{ $flat->image ? asset('storage/' . $flat->image) : asset('images/placeholder.png') }}"
                        alt="{{ $flat->title }}">
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
                        <h4 class="mt-3">Descrizione</h4>
                        <p class="mt-2 text-justify">{{ $flat->description }}</p>
                    </div>
                    @if (count($flat->services))
                        <div class="border my-3"></div>
                    @endif

                    <div class="col-12">
                        @if (count($flat->services))
                            <h4 class="mt-3">Servizi</h4>
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


            <div class="col-lg-6 col-sm-10 col-md-11 col-11">

                <div class="card p-3">
                    <h4 class="mb-0">Statistiche</h4>
                    @include('includes.admin.chart')

                    <div class="mt-5">
                        <h4 class="mb-3">Posizione</h4>
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
