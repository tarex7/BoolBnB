@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Lista Appartamenti</h1>


        <div class="d-flex justify-content-end align-items-center">


            {{-- Add new Flat --}}
            <a class='btn btn-success'href="{{ route('admin.flats.create') }}">
                <i class='fa-solid fa-plus mr-2'></i> Nuovo
                Appartamneto</a>

            <div>
            </div>
        </div>

    </header>


    <table class="table table-striped table-dark">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Numero Camere</th>
                <th scope="col">Numeri Letti </th>
                <th scope="col">Numeri bagni </th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Latitudine</th>
                <th scope="col">Longitudine</th>
                <th scope="col">Visibile</th>
                <th scope="col" class="text-center">Azioni</th>


                </th>

            </tr>
        </thead>
        <tbody>
            @forelse($flats as $flat)
                <tr class=text-center>
                    <th scope="row">{{ $flat->id }}</th>
                    <td>{{ $flat->title }}</td>
                    <td>{{ $flat->room_number }}</td>
                    <td>{{ $flat->bed_number }}</td>
                    <td>{{ $flat->bathroom_number }}</td>
                    <td>{{ $flat->address }}</td>
                    <td>{{ $flat->latitude }}</td>
                    <td>{{ $flat->longitude }}</td>
                    <td>{{ $flat->visible }}</td>

                    <td class="p-1">

                        <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST" class="delete-form"> 

                        
                            <a class='btn btn-sm btn-primary mr-2' href="{{ route('admin.flats.show', $flat) }}"><i
                                    class='fa-solid fa-eye'></i>vedi</a>
                        
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.flats.edit', $flat) }}"><i
                                    class="fa-solid fa-pencil"></i>Edit </a>

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger ml-2" type="submit">
                                <i class="fa-solid fa-trash"></i>Elimina
                            </button> 

                        {{-- @endif --}}
                        </form> 

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <h3 class="text-center">Nessun Appartamneto</h3>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>


    @foreach ($flats as $flat)
        <p>{{ $flat->title }}</p>
        <p>{{ $flat->room_number }}</p>
    @endforeach

    </section>
@endsection
