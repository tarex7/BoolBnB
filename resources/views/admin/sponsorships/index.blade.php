@extends('layouts.app')
@section('content')
    @foreach ($sponsorships as $sponsorship)
        <div class="card">
            <h5 class="card-header">{{$sponsorship->name}}</h5>
            <div class="card-body">
                <h5 class="card-title">{{$sponsorship->price}}€</h5>
                <p class="card-text">{{$sponsorship->duration}} h</p>
                <a href=" {{ route('admin.sponsorships.show', $sponsorship->id) }}" class="btn btn-primary">Attiva la Sponsorizzazione</a>
            </div>
        </div>
    @endforeach
@endsection
ì