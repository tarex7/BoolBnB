@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col mt-5 ">
                    <div class="card basic mt-5">
                        <h1 class="text-center my-3">{{ $sponsorship->name }}</h1>
                        <div class="border"></div>
                        <p class="h4 p-3">Il tuo appartamento sarà tra i primi per <strong class="h2 fw-bold">{{ $sponsorship->duration }}</strong> ore!</p>
                        <div class="border"></div>
                        <h1 class="text-center display-4 my-5"> € {{ $sponsorship->price }} </h1>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
