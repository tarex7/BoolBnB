@extends('layouts.app')


    @section('content')
 <div class="container"> 

         <header>
             <h1 class="text-center">{{ $flat->title }}</h1>
         </header>
         
         <div class="row justify-content-center border">
            <div class="col bg-dark">
              <img src="{{ $flat->image }}" alt="" class="img-fluid">
            </div>
        </div>
            <div class="col bg-primary">
              <h1 class="h4">{{ $flat->title }}</h1>
            </div>
 
        </div> 
        
     @endsection
     