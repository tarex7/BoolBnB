@extends('layouts.app')


    @section('content')
    <div class="container"> 


      <div class="row d-flex">
        <div class="col-6 border">
         <div class="card p-2">
          <h2>{{ $flat->title }}</h2>
          <img src="{{ $flat->image }}" alt="">
         </div>
         <div class="info d-flex mt-4">
          <p class="mx-3">{{ $flat->square_mt }} m<sup>2</sup></p>
          <p class="mx-3"> {{ $flat->bed_number }} letti</p>
          <p class="mx-3"> {{ $flat->bathroom_number }} bagni</p>
         </div>
         <div class="d-flex justify-content-between"><p class="mx-3 fw-bolder h5 mt-2">Prezzo per notte</p><strong class="h3 text-danger mx-3 ">{{ $flat->price_per_day }} €</strong></div>
         <div class="border my-3"></div>

         <div class="col-12">
          <h3 class="mt-3">Descrizione</h3>
          <p class="mt-2 text-justify">{{ $flat->description }}</p>
        </div>
        <div class="border my-3"></div>
        <div class="col-12">
          <h3 class="mt-3">Servizi</h3>
         @foreach ($services as $service)
          
            <p class="mt-2 text-justify">{{$service->label }}</p>
         
             
         @endforeach
        </div>
        </div>
      </div>
    </div>

        
         
       
        
    @endsection
     