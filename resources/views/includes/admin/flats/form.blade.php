{{-- ACTIVE PER VEDERE LA VALIDAZIONE A INIZIO PAGINA --}}
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </div>
@endif

@if ($flat->exists)
    <form action="{{ route('admin.flats.update', $flat) }}" method="POST" enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif

@csrf

<div class="container-fluid d-flex justify-content-center">
    <div class="card rounded-lg p-4 col-9 shadow">
        <div class="row">

            <div class="col-5">
                {{-- IMAGE --}}


                <div class="border rounded mt-4">
                    <img src="{{ $flat->image ? asset('storage/' . $flat->image) : asset('images/placeholder.png') }}"
                    alt="flat-image" id="preview" class="img-fluid">
                </div>


                <div class="mb-3 col-12 p-0">
                    <input type="file" class="my-3 @error('image') is-invalid @enderror" id="image"
                        name="image">
                    {{-- MESSAGGIO ERRORE --}}
                    @error('image')
                        <div class="invalid-feedback">{{ $message }} </div>
                    @enderror

                </div>

                {{-- VISIBILITA' --}}
                <div class="mb-3 form-check col-6  p-3">
                    <input type="checkbox" class="form-check-input" id="visible" name="visible" value="1"
                        @if (old('visible', $flat->visible)) checked @endif>
                    <label class="form-check-label" for="visible">Rendi visibile l'appartamento</label>
                </div>

            </div>

            <div class="col-7">

                {{-- Titolo --}}
                <div class="form-group">
                    <label for="title" class="">Titolo *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $flat->title) }}" required minlength="5" maxlength="50">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="row">


                    {{-- Descrizione --}}
                    <div class="mb-3 col-12">
                        <div class="form-floating">
                    <label for="description" class="">Descrizione *</label>

                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Leave a comment here"
                                id="description" style="height: 300px" name="description">{{ old('description', $flat->description) }}</textarea>

                            {{-- MESSAGGIO ERRORE --}}
                            @error('description')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror

                        </div>

                        {{-- Indirizzo --}}
                        {{-- Titolo --}}
                        {{-- <div class="form-group mt-4">
                            <label for="address" class=" mb-1">Indirizzo</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" value="{{ old('address', $flat->address) }}" required
                                minlength="5" maxlength="50">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}

                        {{-- Indirizzo tomtom searchbar --}}

                        <div class="form-group">
                            <label for="address">Indirizzo: *</label>
                            <div id="address-tomtom"></div>

                            <input id="lat" type="text" class="form-control" name="latitude" 
                                value="{{ old('latitude', $flat->latitude) }}" hidden>
                    
                            <input id="lon" type="text" class="form-control" name="longitude" 
                                value="{{ old('longitude', $flat->longitude) }}" hidden>
                    
                    
                        </div>
                    

                        <div class="d-flex mt-2">
                            {{-- METRI QUADRI --}}
                            <div class="my-3 col-6 p-0">
                                <label for="square_mt" class="form-label ">Superfice mq<sup>2</sup> *</label>
                                <input type="number" class="form-control @error('square_mt') is-invalid @enderror"
                                    id="square_mt" name="square_mt" step="1"
                                    value="{{ old('square_mt', $flat->square_mt) }}">

                                {{-- MESSAGGIO ERRORE --}}
                                @error('square_mt')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>

                            {{-- NUMERO STANZE --}}
                            <div class="my-3 col-6">
                                <label for="room_number" class="form-label ">Camere *</label>
                                <input type="number" class="form-control @error('room_number') is-invalid @enderror"
                                    id="room_number" name="room_number" step="1"
                                    value="{{ old('room_number', $flat->room_number) }}">
                                {{-- MESSAGGIO ERRORE --}}
                                @error('room_number')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex">
                            {{-- NUMERO LETTI --}}
                            <div class="my-3 col-6 p-0">
                                <label for="bed_number" class="form-label ">Letti *</label>
                                <input type="number" class="form-control @error('bed_number') is-invalid @enderror"
                                    id="bed_number" name="bed_number" step="1"
                                    value="{{ old('bed_number', $flat->bed_number) }}">
                                {{-- MESSAGGIO ERRORE --}}
                                @error('bed_number')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>

                            {{-- NUMERO BAGNI --}}
                            <div class="my-3 col-6">
                                <label for="bathroom_number" class="form-label ">Bagni *</label>
                                <input type="number"
                                    class="form-control @error('bathroom_number') is-invalid @enderror"
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
                            <p class="mb-2 ">Servizi</p>

                            <div class=" d-flex flex-wrap justify-content-between">

                                @foreach ($services as $service)
                                    <div class="my-2 mr-2 w-25">
                                        <input class="mr-0" type="checkbox"
                                            @if (in_array($service->id, old('services', $services_ids))) checked @endif
                                            id="{{ $service->label }}" name="services[]"
                                            value="{{ $service->id }}">
                                        <label class="form-check-label mr-1" for="{{ $service->label }}">
                                            {{ $service->label }} <i class="{{ $service->icon }}"></i>
                                        </label>
                                    </div>
                                @endforeach

                            </div>


                            {{-- PREZZO PER NOTTE --}}

                            <p class="mt-4 mb-2">Prezzo per notte *</p>
                            <div class="input-group mb-3 col-3 p-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">€</span>
                                </div>

                                <input type="number"
                                    class="form-control @error('price_per_day') is-invalid @enderror"
                                    id="price_per_day" name="price_per_day" step="1"
                                    value="{{ old('price_per_day', $flat->price_per_day) }}">

                                {{-- MESSAGGIO ERRORE --}}
                                @error('price_per_day')
                                    <div class="invalid-feedback">{{ $message }} </div>

                                </div>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end align-items-center my-5 px-5">
                    <button type="submit" class="btn {{ !$flat->exists ? 'btn-success' : 'btn-warning' }} mr-5">{{ !$flat->exists ? 'Crea appartamento' : 'Aggiorna appartamento' }}</button>
                    <a href="{{ route('admin.flats.index') }}" class="btn btn-primary">Indietro</a>
                </div>
            </div>

            </form>

            <script>
                var options = {
                    searchOptions: {
                        key: 'I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh',
                        language: 'it-IT',
                        limit: 10,
                    },
                    autocompleteOptions: {
                        key: 'I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh',
                        language: 'it-IT',
                    }
                };
                const latInput = document.getElementById('lat');
                const lonInput = document.getElementById('lon');
                const addressContainer = document.getElementById('address-tomtom')
            
                const testbtn = document.getElementById('test');
            
                var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
                var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
                addressContainer.append(searchBoxHTML);
                const tomtomInput = document.getElementsByClassName("tt-search-box-input")[0];
                let date = {}
                ttSearchBox.on("tomtom.searchbox.resultsfound", function(data) {
                    date = (data);
                    let position = date.data.results.fuzzySearch.results[0].position;
                    let lon = position.lng;
                    let lat = position.lat;
                    latInput.value = lat;
                    lonInput.value = lon;
                });
                tomtomInput.setAttribute("name", "address");
                tomtomInput.value = "<?php echo $flat->address; ?>";
            
                 //let axios = require('axios').default;
            
                
            
            
                addressContainer.addEventListener("input", (e) => {
                    console.log('call');
                     axios.get(
                             `https:api.tomtom.com/search/2/autocomplete/${addressContainer.value}.json?key=I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh&language=it-IT&limit=6`
                         )
                         .then((res) => {
                             console.log(res.data);
                         })
                });
            </script>

            <script>
                const placeholder = "https://cdn2.vectorstock.com/i/thumb-large/48/06/image-preview-icon-picture-placeholder-vector-31284806.jpg";
                const image = document.getElementById('image')
                const preview = document.getElementById('preview')

                image.addEventListener('input', () => {
                    if (image.files && image.files[0]) {
                        let reader = new FileReader();
                        reader.readAsDataURL(image.files[0]);
                        reader.addEventListener('load', event => {
                            preview.src = event.target.result;
                        });
                    } else preview.src = placeholder;
                    preview.setAttribute('src', placeholder);
                })
            </script>

        <script src="{{ asset('js/image_preview.js') }}"></script>



            
