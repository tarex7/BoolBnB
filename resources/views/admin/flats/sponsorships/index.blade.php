@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-5">Scegli la tua sponsorizzazione</h1>
            </div>
            @foreach ($sponsorships as $sponsorship)
                <div class="col mt-5 ">

                    <div class="card basic mt-3">
                        <h1 class="text-center my-3">{{ $sponsorship->name }}</h1>
                        <div class="border"></div>
                        <p class="h4 p-3 my-5 text-center">Il tuo appartamento sarà sponsorizzato  per <strong class="h2 fw-bold">{{ $sponsorship->duration }}</strong> ore!</p>
                        <div class="border"></div>
                        <h1 class="text-center display-4 my-4"> € {{ $sponsorship->price }} </h1>
                        <div class="d-flex justify-content-center my-5">
                        <a href="{{Route('admin.sponsorship.show',$sponsorship)}}" class="btn btn-success btn-lg rounded-0 w-50">Scegli</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
