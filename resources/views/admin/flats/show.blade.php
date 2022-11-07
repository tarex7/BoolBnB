@extends('layouts.app')


@section('content')
    <div class="container">



        <div class="d-flex justify-content-between my-5">
            @if ($flat->user_id === Auth::id())

                

                <div class="row">
                    <div class="col-12 my-3 d-flex justify-content-center ">
                        <a href="{{ route('admin.sponsorships') }}" class=" btn-third-cs  "><strong class="h5 "></i>Metti in
                                vista il tuo appartamento!</strong></a>
                    </div>

                    <div class="col-12 my-3">
                        <div class="d-flex justify-content-between justify-content-md-end">
                            <a href="{{ route('admin.flats.edit', $flat->id) }}" class="  btn-third-cs "><strong
                                    class="h6">Modifica </strong></a>
                            <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary-cs text-light  mx-3"> <strong class="h6">Elimina
                                    </strong></button>
                            </form>
                            <a href="{{ route('admin.flats.index') }}" class=" btn-secondary-cs text-white"><strong
                                    class="h6">Torna alla lista </strong></a>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card p-4">
                            <h5>{{ $flat->title }}</h5>


                            <img class=" mr-2 img-fluid"
                                src="{{ asset('storage/' . $flat->image) }}" alt="{{ $flat->title }}">

                            <p class=" my-1 py-2">{{ $flat->address }}</p>
                            <div class="info row row-cols-2 mt-1 border align-items-center  p-3">
                                <p class="col"><i class="fa-solid fa-2xs me-1 fa-circle"></i>{{ $flat->square_mt }}
                                    m<sup>2</sup></p>
                                <p class="col"><i class="fa-solid fa-2xs me-1 fa-circle"></i> {{ $flat->bed_number }}
                                    letti</p>
                                <p class="col"><i class="fa-solid fa-2xs me-1 fa-circle"></i> {{ $flat->room_number }}
                                    stanze</p>
                                <p class="col"><i class="fa-solid fa-2xs me-1 fa-circle"></i>
                                    {{ $flat->bathroom_number }} bagni</p>
                            </div>

                            <div class="d-flex  mt-1  py-2">
                                <p class="  h5 mt-2 mb-0 ">Prezzo per notte</p>
                                <p class="h3 mb-0 ms-2 text-danger mx-3 mt-1 ms-5 ">{{ $flat->price_per_day }} €</p>
                            </div>

                            <div class="border my-3"></div>

                            <div class="col-12">
                                <h5 class="mt-3">Descrizione</h5>
                                <p class="mt-2 text-justify">{{ $flat->description }}</p>
                            </div>
                            @if (count($flat->services))
                                <div class="border my-3"></div>
                            @endif

                            <div class="col-12">
                                @if (count($flat->services))
                                    <h4 class="mt-3">Servizi</h4>
                                @endif
                                <div class="row row-cols-3">

                                    @foreach ($flat->services as $service)
                                        <p class="mt-2 col"><i class="{{ $service->icon }} fa-lg"></i>
                                            {{ $service->label }}
                                        </p>
                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-lg-6">

                        <div class="card p-3">
                            @include('includes.admin.chart')
                
                            <div class="mt-5">
                                <h4 class="mb-3">Mappa</h4>
                                <div class="border"></div>
                                @include('includes.map')
                
                
                            </div>
                
                        </div>
                
                    </div>

                    <div class="col-12">
                        <div class="border my-5 ">
                            <h3 class="my-2 text-center">Messaggi</h3>
                
                            <ol class="list-group list-group-numbered rounded-0 px-5 ">
                                @foreach ($messages as $message)
                                    <li class="list-group-item  d-flex justify-content-between align-items-start my-3">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold mb-1">Messaggio da : <strong>{{ $message->sender_name }}</strong></div>
                                            <span class="">Ricevuto il: {{ $message->getDate($message->created_at) }} alle ore
                                                {{ $message->getTime($message->created_at) }}</span>
                
                                            <div class="border mb-3"></div>
                                            {{ $message->text }}
                                        </div>
                                        <div class="d-flex">
                                            {{-- <form action="">
                                                <button class="btn btn-danger btn-sm">Elimina</button>
                                            </form> --}}
                                        </div>
                                    </li>
                                @endforeach
                
                
                
                
                
                            </ol>
                        </div>
                
                
                    </div>


                </div>
            @endif
        </div>

    </div>




    

    

    </div>

    </div>
@endsection
