{{-- ACTIVE PER VEDERE LA VALIDAZIONE A INIZIO PAGINA --}}
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </div>
@endif --}}

@extends('layouts.app')
@if ($flat->exists)
    <form action="{{ route('admin.flats.update', $flat) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
@endif

@csrf
<div class="container">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                name="title" value="{{ old('title', $flat->title) }}" required minlength="5" maxlength="50">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- IMAGE --}}
        <div class="row">
            <div class="col-8 ">
                <img class="img-fluid"
                    src="{{ $flat->image ? asset('storage/' . $flat->image) : 'https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png' }}"
                    alt="flat-image" id="preview">

            </div>

            <div class="col-11">
                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input type="file" id="image" name="image">

                </div>
            </div>





            {{-- Descrizione --}}
            <div class="mb-3 col-12">
                <div class="form-floating">
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Leave a comment here"
                        id="description" style="height: 300px" name="description">{{ old('description', $flat->description) }}</textarea>
                    <label for="description">Descrizione</label>
                    {{-- MESSAGGIO ERRORE --}}
                    @error('description')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror
                </div>
            </div>



            {{-- PREZZO PER NOTTE --}}
            <div class="mb-3 col-3">
                <label for="price_per_day" class="form-label">Prezzo</label>
                <input type="number" class="form-control @error('price_per_day') is-invalid @enderror" id="price"
                    name="price_per_day" step="0.1" value="{{ old('price_per_day', $flat->price_per_day) }}">
                {{-- MESSAGGIO ERRORE --}}
                @error('price_per_day')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror

            </div>

            {{-- NUMERO STANZE --}}
            <div class="mb-3 col-3">
                <label for="room_number" class="form-label">Camere</label>
                <input type="number" class="form-control @error('room_number') is-invalid @enderror" id="room_number"
                    name="room_number" step="1" value="{{ old('room_number', $flat->room_number) }}">
                {{-- MESSAGGIO ERRORE --}}
                @error('room_number')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
        </div>

        {{-- NUMERO LETTI --}}
        <div class="mb-3 col-3">
            <label for="bed_number" class="form-label">Letti</label>
            <input type="number" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number"
                name="bed_number" step="1" value="{{ old('bed_number', $flat->bed_number) }}">
            {{-- MESSAGGIO ERRORE --}}
            @error('bed_number')
                <div class="invalid-feedback">{{ $message }} </div>
            @enderror
        </div>

        {{-- NUMERO BAGNI --}}
        <div class="mb-3 col-3">
            <label for="bathroom_number" class="form-label">Bagni</label>
            <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror"
                id="bathroom_number" name="bathroom_number" step="1"
                value="{{ old('bathroom_number', $flat->bathroom_number) }}">
            {{-- MESSAGGIO ERRORE --}}
            @error('bathroom_number')
                <div class="invalid-feedback">{{ $message }} </div>
            @enderror
        </div>

        {{-- METRI QUADRI --}}
        <div class="mb-3 col-3">
            <label for="square_mt" class="form-label">Dimensione</label>
            <input type="number" class="form-control @error('square_mt') is-invalid @enderror" id="square_mt"
                name="square_mt" step="1" value="{{ old('square_mt', $flat->square_mt) }}">
            {{-- MESSAGGIO ERRORE --}}
            @error('square_mt')
                <div class="invalid-feedback">{{ $message }} </div>
            @enderror
        </div>

        {{-- VISIBILITA' --}}
        <div class="mb-3 form-check col-6">
            <input type="checkbox" class="form-check-input" id="visible" name="visible" value="1"
                @if (old('visible', $flat->visible)) checked @endif>
            <label class="form-check-label" for="visible">Pubblicato</label>
        </div>

        {{-- CHECKBOX - SERVICE --}}
        @foreach ($services as $service)
            <div class="form-group form-check-inline">
                <input class="mr-2" type="checkbox" @if (in_array($service->id, old('services', $services_ids))) checked @endif
                    id="{{ $service->label }}" name="services[]" value="{{ $service->id }}">
                <label class="form-check-label" for="{{ $service->label }}">
                    {{ $service->label }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
