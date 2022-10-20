@extends('layouts.app')
@include('includes.header')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 wrapper d-flex flex-wrap">
                @forelse ($flats as $flat)
                    <div class="flat-card bg-dark me-2">
                        {{-- <img src="{{ $comic->thumb }}"alt=""> --}}
                        <div class="imaginary"></div>
                        <div class="appair">
                            <div class="d-flex flex-column align-items-center">
                                <a class="btn btn-primary text-light my-2 p-1 "
                                    href="{{ route('admin.flats.show', $flat->id) }}">
                                    Visualizza
                                </a>
                                <a class="btn bg-secondary text-light my-2 p-1"
                                    href="{{ route('admin.flats.edit', $flat->id) }}">
                                    Modifica
                                </a>
                                <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn bg-danger text-light my-2 p-1"> Elimina</button>
                                </form>
                            </div>
                        </div>
                        <h5 class="fw-bold text-light mt-3 fs-6">{{ $flat->title }}</h5>
                    </div>
                @empty
                    <tr>
                        <td colspan="8">
                            <h3 class="text-center">Nessun Appartamneto</h3>
                        </td>
                    </tr>
                @endforelse
            </div>
        </div>
    </div>
