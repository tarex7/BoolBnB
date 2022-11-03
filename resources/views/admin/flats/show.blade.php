@extends('layouts.app')


@section('content')
    <div class="container">


        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-end my-3">
                    @if ($flat->user_id === Auth::id())
                        <a href="{{ route('admin.flats.edit', $flat->id) }}" class="btn  btn-warning "><strong
                                class="h5">Modifica </strong></a>
                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-light  mx-3"> <strong class="h5">Elimina
                                </strong></button>
                        </form>
                    @endif
                    <a href="{{ route('admin.flats.index') }}" class="btn btn-primary text-white"><strong
                            class="h5">Torna alla lista </strong></a>
                </div>
            </div>
            <div class="col-6">
                <div class="card p-4">
                    <h2>{{ $flat->title }}</h2>


                    <img class="float-left mr-2 img-fluid" width="500" src="{{ asset('storage/' . $flat->image) }}"
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


            <div class="col-6">

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
                <div class="border my-5 "><h2 class="my-2 text-center">Messaggi</h2>
                
                    <ol class="list-group list-group-numbered">
                        @foreach ($messages as $message)
                        <li class="list-group-item d-flex justify-content-between align-items-start my-3" >
                          <div class="ms-2 me-auto">
                            <div class="fw-bold mb-1">Messaggio da : <strong>{{ $message->sender_name}}</strong></div>
                          <span class="">Ricevuto il: {{ $message->getDate($message->created_at) }} alle ore {{ $message->getTime($message->created_at) }}</span>
    
                            <div class="border mb-3"></div>
                            {{ $message->text}}
                          </div>
                          <div class="d-flex">
                            <form action="">
                                <button class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                          </div>
                        </li>
                        @endforeach
    
    
    
    
                       
                      </ol>
                </div>


            </div>

        </div>

    </div>
@endsection
