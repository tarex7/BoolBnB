@extends('layouts.app')

@section('content')
    <style>
        .bg-img {
            background-image: url("/images/money.jpg");
            position: relative;
            top: 0;
            left: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            z-index: 1;
            height: 75vh;
        }

        .bg-img-2 {
            background-image: url("/images/home.jpg");
            position: relative;
            top: 0;
            left: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .text-z {
            z-index: 2;
            position: absolute;
            top: 50%;

            left: 55%;
            transform: translate(-50%, -50%);
        }

        .new {
            font-size: 75px;
            color: goldenrod;
            text-shadow: 2px 2px 4px black;

        }

        @media only screen and (min-width: 285px) {
            .card {
                width: 90%;
            }
        }

        @media only screen and (min-width: 442px) {
            .card {
                width: 70%;
                padding-bottom: 2rem;
            }
        }

        @media only screen and (min-width: 580px) {
            .card {
                width: 45%;
            }
        }

        @media only screen and (min-width: 992px) {

            .new {
                display: flex;
                text-align: center;
                font-size: 35px;
                left: 50%;

            }

            .card {
                width: 23%;
            }
        }

        @media only screen and (min-width: 1200px) {

            .card {
                width: 20%;
            }
        }
    </style>
    @if (count($flats) === 0)
        <div class="bg-img pb-5">
        @else
            <div class="bg-img-2">
    @endif
    <div class="container-fluid">
        <div class="row">
            @if (count($flats) > 0)
            <div class="col-12 d-flex justify-content-end my-5 px-5 ">
                <a href="{{ route('admin.flats.create') }}" class=" btn-primary-cs  text-white "><strong
                        class="h6">Aggiungi appartamento</strong></a>
                <div class="offset-1"></div>
            </div>
            @endif
            <div class="col-12 wrapper d-flex flex-wrap justify-content-center">
                @forelse ($flats as $flat)
                    <div class="card m-2 p-2 shadow" style="width: 20rem;">
                        <a href="{{ Route('admin.flats.show', $flat->id) }}">
                            <img src="{{ $flat->image ? asset('storage/' . $flat->image) : asset('images/placeholder.png') }}"
                            style="height: 15rem;" class="card-img-top {{ !$flat->visible ? 'opacity-25' : '' }}"
                            alt="...">

                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $flat->title }}</h5>

                            <form action="{{ route('admin.flats.toggle', $flat) }}" method="POST"
                                class="m-0 d-flex justify-content-between">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-outline d-flex align-items-center px-0" type='submit'>
                                    <i
                                        class="fa-xl fa-solid fa-toggle-{{ $flat->visible ? 'on' : 'off' }} text-{{ $flat->visible ? 'success' : 'danger' }} "></i>
                                    <h5 class="m-0 mx-2">{{ $flat->visible ? 'Visibile' : 'Non visibile' }}</h5>
                                </button>
                                <i class="fa-regular fa-xl fa-envelope mt-3"></i>

                            </form>
                        </div>
                    </div>

                @empty
                <div class="text-z">
                    <h3 class="new">Vuoi avere una nuova entrata?</h3>
                    <div class=" d-flex justify-content-center my-5">
                        <a href="{{ route('admin.flats.create') }}" class="btn btn-primary  text-white  p-2"><strong
                                class="h5">Inserisci il tuo
                                appartamento</strong></a>
                        <div class="offset-1"></div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
