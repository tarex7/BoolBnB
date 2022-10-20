@extends('layouts.app')


    @section('content')
 <div class="container"> 

         <header>
             <h1 class="text-center">{{ $flat->title }}</h1>
         </header>
         
         <div class="row justify-content-center border">
            <div class="col bg-dark">
              <img src="https://a0.muscache.com/im/pictures/miso/Hosting-631564783833927857/original/42232fae-ee5a-40c9-b24b-24571763df7b.jpeg?im_w=1200" alt="" class="img-fluid">
            </div>
        </div>
            <div class="col bg-primary">
              <h1 class="h4">{{ $flat->title }}</h1>
            </div>
 
        </div> 
        
     @endsection
     