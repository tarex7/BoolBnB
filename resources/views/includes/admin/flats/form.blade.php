{{-- ACTIVE PER VEDERE LA VALIDAZIONE A INIZIO PAGINA --}}
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </div>
@endif --}}

@if ($flat->exists)
<form action="{{ route('admin.flats.update', $flat) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
@endif

@csrf

<div class="container-fluid d-flex justify-content-center">
    <div class="card rounded-lg p-4 col-9 shadow">
        <div class="row">

            <div class="col-5">
               {{-- IMAGE --}}
               
                
                <img class="w-100"
                src="{{ $flat->image ?? 'https://images.vexels.com/media/users/3/131734/isolated/preview/05d86a9b63d1930d6298b27081ddc345-photo-preview-frame-icon.png' }}"
                alt="flat-image" id="preview">
               
    
                <div class="mb-3 col-12 p-0">
                    <input type="file" class="my-3" id="image" name="image"
                        value="{{ old('image', $flat->image) }}">
                </div>
    
            </div>
           
            <div class="col-7">

                 {{-- Titolo --}}
                <div class="form-group">
                    <label for="title" class="h4">Titolo</label>
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

          





            {{-- Descrizione --}}
            <div class="mb-3 col-12">
                <div class="form-floating">
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Leave a comment here"
                        id="description" style="height: 300px" name="description">{{ old('description', $flat->description) }}</textarea>

                    {{-- MESSAGGIO ERRORE --}}
                    @error('description')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror

                </div>

                {{-- Indirizzo --}}
                 {{-- Titolo --}}
                 <div class="form-group mt-4">
                    <label for="address" class="h4 mb-1">Indirizzo</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', $flat->address) }}" required minlength="5" maxlength="50">

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex mt-2">
                    {{-- METRI QUADRI --}}
                    <div class="my-3 col-6 p-0">
                        <label for="square_mt" class="form-label">Superfice mq<sup>2</sup></label>
                        <input type="number" class="form-control @error('square_mt') is-invalid @enderror" id="square_mt"
                            name="square_mt" step="1" value="{{ old('square_mt', $flat->square_mt) }}">

                        {{-- MESSAGGIO ERRORE --}}
                        @error('square_mt')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>

                    {{-- NUMERO STANZE --}}
                    <div class="my-3 col-6">
                        <label for="room_number" class="form-label">Camere</label>
                        <input type="number" class="form-control @error('room_number') is-invalid @enderror" id="room_number"
                            name="room_number" step="1" value="{{ old('room_number', $flat->room_number) }}">
                        {{-- MESSAGGIO ERRORE --}}
                        @error('room_number')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>
    
                </div>

                <div class="d-flex">
                     {{-- NUMERO LETTI --}}
                <div class="my-3 col-6 p-0">
                    <label for="bed_number" class="form-label">Letti</label>
                    <input type="number" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number"
                        name="bed_number" step="1" value="{{ old('bed_number', $flat->bed_number) }}">
                    {{-- MESSAGGIO ERRORE --}}
                    @error('bed_number')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror
                </div>
        
                {{-- NUMERO BAGNI --}}
                <div class="my-3 col-6">
                    <label for="bathroom_number" class="form-label">Bagni</label>
                    <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror"
                        id="bathroom_number" name="bathroom_number" step="1"
                        value="{{ old('bathroom_number', $flat->bathroom_number) }}">
                    {{-- MESSAGGIO ERRORE --}}
                    @error('bathroom_number')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror
                </div>

                </div>

                <div class="col-12 p-0 mt-2">
                    {{-- CHECKBOX - SERVICE --}}
               <p class="mb-2 h4">Servizi</p>
               
               <div class=" d-flex flex-wrap justify-content-between">

                    @foreach ($services as $service)

                    <div class="my-2 mr-2 w-25">
                        <input class="mr-0" type="checkbox" @if (in_array($service->id, old('services', $services_ids))) checked @endif
                        id="{{ $service->label }}" name="services[]" value="{{ $service->id }}">
                    <label class="form-check-label mr-1" for="{{ $service->label }}">
                        {{ $service->label }} <i class="{{ $service->icon }}"></i>
                    </label>
                    </div>

                    @endforeach

                </div>

                


                 {{-- PREZZO PER NOTTE --}}

                 <h4 class="mt-4 mb-2">Prezzo per notte</h4>
                <div class="input-group mb-3 col-3 p-0">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">€</span>
                    </div>

                    <input type="number" class="form-control @error('price_per_day') is-invalid @enderror" id="price_per_day"
                    name="price_per_day" step="1" value="{{ old('price_per_day', $flat->price_per_day) }}">

                    {{-- MESSAGGIO ERRORE --}}
                    @error('price_per_day')
                    <div class="invalid-feedback">{{ $message }} </div>

                </div>

               @enderror

                </div>
            </div>
    </div>
    <div class="col-12 d-flex justify-content-end align-items-center">
     <button type="submit" class="btn btn-success mr-4">Aggiorna l'appartamento</button>
     <a href="{{ route('admin.flats.index') }}" class="btn btn-primary">Indietro</a>
    </div>
</div>
</form>
