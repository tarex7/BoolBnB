
@extends('layouts.app')


    @section('content')
    <div class="container"> 


          <div class="row">
            <div class="col-5">
              <div class="card p-4">
                <h2>{{ $flat->title }}</h2>
                <img src="{{ $flat->image }}" alt="">
             </div>
  
            <div class="info d-flex mt-4">
              <p class="mx-3">{{ $flat->square_mt }} m<sup>2</sup></p>
              <p class="mx-3"> {{ $flat->bed_number }} letti</p>
              <p class="mx-3"> {{ $flat->bathroom_number }} bagni</p>
            </div>
  
              <div class="d-flex justify-content-between"><p class="mx-3 fw-bolder h5 mt-2">Prezzo per notte</p><strong class="h3   text-danger mx-3 ">{{ $flat->price_per_day }} €</strong>
              </div>
  
              <div class="border my-4"></div>
  
            <div class="col-12">
              <h3 class="mt-3">Descrizione</h3>
              <p class="mt-2 text-justify">{{ $flat->description }}</p>
            </div>
  
            <div class="border my-4"></div>
  
            <div class="col-12">
              <h3 class="mt-3">Servizi</h3>
              <div class="d-flex justify-content-between flex-wrap">
  
              @foreach ($flat->services as $service)
              
                <p class="mt-2 me-5"><i class="{{ $service->icon }} fa-2x"></i> {{$service->label }}</p>
            
               @endforeach
                
              </div>
            
            </div>
          </div>
        
              
              <div class="col-7">
                
                <div class="card p-3">
                  <h2 class="mb-3">Statistiche</h2>
                  @include('includes.admin.chart')
                </div>

              </div>
              <div class="col-12">
            <div class="border my-4"></div>
                
                <h3>Posizione</h3>
                @include('includes.map')

              </div>

          </div>
           
    </div>
    

         
       @endsection
        
    
     