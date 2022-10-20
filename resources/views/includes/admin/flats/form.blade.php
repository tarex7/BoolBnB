@if ($flat->exists)
    <form action="{{ route('admin.flats.update', $flat) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.flats.store') }}" method="POST">
@endif

@csrf
<div class="container">
    <div class="row">

        <div class="mb-3 col-12">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $flat->title) }}">
        </div>

        <div class="mb-3 col-12">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 400px"
                    name="description">{{ old('description', $flat->description) }}</textarea>
                <label for="floatingTextarea2">Descrizione</label>
            </div>
        </div>

        <div class="mb-3 col-10">
            <label for="image" class="form-label">Immagine</label>
            <input type="url" class="form-control" id="image-field" name="image"
                value="{{ old('image', $flat->image) }}">
        </div>
        <div class="col-2">
            <img class="img-fluid"
                src="{{ $flat->image ?? 'https://cdn2.vectorstock.com/i/thumb-large/48/06/image-preview-icon-picture-placeholder-vector-31284806.jpg' }}"
                alt="flat-image" id="preview">
        </div>

        <div class="mb-3 col-3">
            <label for="price_per_day" class="form-label">Prezzo</label>
            <input type="number" class="form-control" id="price" name="price_per_day" step="0.1"
                value="{{ old('price', $flat->price_per_day) }}">
        </div>

        <div class="mb-3 col-3">
            <label for="room_number" class="form-label">Camere</label>
            <input type="number" class="form-control" id="room_number" name="room_number" step="1"
                value="{{ old('price', $flat->room_number) }}">
        </div>

        <div class="mb-3 col-3">
            <label for="bed_number" class="form-label">Letti</label>
            <input type="number" class="form-control" id="bed_number" name="bed_number" step="1"
                value="{{ old('price', $flat->bed_number) }}">
        </div>

        <div class="mb-3 col-3">
            <label for="bathroom_number" class="form-label">Bagni</label>
            <input type="number" class="form-control" id="bathroom_number" name="bathroom_number" step="1"
                value="{{ old('price', $flat->bathroom_number) }}">
        </div>

        <div class="mb-3 col-3">
            <label for="square_mt" class="form-label">Dimensione</label>
            <input type="number" class="form-control" id="square_mt" name="square_mt" step="1"
                value="{{ old('price', $flat->square_mt) }}">
        </div>

        <div class="mb-3 form-check col-6">
            <input type="checkbox" class="form-check-input" id="visible">
            <label class="form-check-label" for="visible">Visibile</label>
        </div>

        @foreach ($services as $service)
            <div class="form-group form-check-inline">
                <input type="checkbox" class="form-check-input" id="service-{{ $service->label }}" name="services[]"
                    value="{{ $service->id }}">
                <label for="service-{{ $service->label }}">{{ $service->label }}</label>
            </div>
        @endforeach


        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
