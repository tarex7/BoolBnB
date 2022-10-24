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
<div class="container">

    {{-- IMAGE --}}
    <div class="row">
        <div class="col-8 ">
            <img class="img-fluid"
                src="{{ $flat->image ?? 'https://images.vexels.com/media/users/3/131734/isolated/preview/05d86a9b63d1930d6298b27081ddc345-photo-preview-frame-icon.png' }}"
                alt="flat-image" id="preview">
        </div>

        <div class="mb-3 col-6">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control" id="image-field" name="image"
                value="{{ old('image', $flat->image) }}">
        </div>

        {{-- TITLE --}}
        <div class="mb-3 col-12">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title', $flat->title) }}">
                {{-- MESSAGGIO ERRORE --}}
                @error('title')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
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
                name="price_per_day" step="0.1" value="{{ old('price', $flat->price_per_day) }}">
            {{-- MESSAGGIO ERRORE --}}
            @error('price_per_day')
                <div class="invalid-feedback">{{ $message }} </div>
            @enderror

        </div>

        {{-- NUMERO STANZE --}}
        <div class="mb-3 col-3">
            <label for="room_number" class="form-label">Camere</label>
            <input type="number" class="form-control @error('room_number') is-invalid @enderror" id="room_number"
                name="room_number" step="1" value="{{ old('price', $flat->room_number) }}">
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
            name="bed_number" step="1" value="{{ old('price', $flat->bed_number) }}">
        {{-- MESSAGGIO ERRORE --}}
        @error('bed_number')
            <div class="invalid-feedback">{{ $message }} </div>
        @enderror
    </div>

    {{-- NUMERO BAGNI --}}
    <div class="mb-3 col-3">
        <label for="bathroom_number" class="form-label">Bagni</label>
        <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror" id="bathroom_number"
            name="bathroom_number" step="1" value="{{ old('price', $flat->bathroom_number) }}">
        {{-- MESSAGGIO ERRORE --}}
        @error('bathroom_number')
            <div class="invalid-feedback">{{ $message }} </div>
        @enderror
    </div>

    {{-- METRI QUADRI --}}
    <div class="mb-3 col-3">
        <label for="square_mt" class="form-label">Dimensione</label>
        <input type="number" class="form-control @error('square_mt') is-invalid @enderror" id="square_mt"
            name="square_mt" step="1" value="{{ old('price', $flat->square_mt) }}">
        {{-- MESSAGGIO ERRORE --}}
        @error('square_mt')
            <div class="invalid-feedback">{{ $message }} </div>
        @enderror
    </div>

    {{-- VISIBILITA' --}}
    <div class="mb-3 form-check col-6">
        <input type="checkbox" class="form-check-input" id="visible">
        <label class="form-check-label" for="visible">Visibile</label>
    </div>

    {{-- CHECKBOX - SERVICE --}}
    @foreach ($services as $service)
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="service-{{ $service->label }}" name="services[]"
                value="{{ $service->id }}">
            <label for="service-{{ $service->label }}">{{ $service->label }}</label>
        </div>
    @endforeach

    <div class="form-group">
        <label for="address">Indirizzo:</label>
        <div id="address-tomtom">
        </div>
        <input id="lat" type="text" class="form-control" name="latitude" id="lat"
            value="{{ old('latitude', $flat->latitude) }}" hidden>

        <input id="lon" type="text" class="form-control" name="longitude" id="lon"
            value="{{ old('longitude', $flat->longitude) }}" hidden>


    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
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
    var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
    var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
    addressContainer.append(searchBoxHTML);
    const tomtomInput = document.getElementsByClassName("tt-search-box-input")[0];
    let date = {}
    ttSearchBox.on('tomtom.searchbox.resultsfound', function(data) {
        date = (data);
        let position = date.data.results.fuzzySearch.results[0].position;
        let lon = position.lng;
        let lat = position.lat;
        latInput.value = lat;
        lonInput.value = lon;
    });
    tomtomInput.setAttribute("name", "address");
    tomtomInput.value = '<?php echo $flat->address; ?>';

    let axios = require('axios').default;

    addressContainer.addEventListener("keyup", (event) => {
        axios.get(
                `https://api.tomtom.com/search/2/autocomplete/${addressContainer.value}.json?key=I7jwOnv7XxCbU6AV64AN8ZPGArFaIoTh&language=it-IT&limit=6`
            )
            .then((res) => {
                console.log(res.data);
            })
    });
</script>
</form>
