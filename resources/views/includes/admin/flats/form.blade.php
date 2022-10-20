<div class="row border">
        <div class="col-6 col-md-12 mx-5">
            <form action="{{ route('admin.flats.store') }}" method="POST">
                @csrf
    
            <div class="mb-3 col-6">
              <label for="title" class="form-label">Titolo</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
    
            <div class="mb-3 col-6">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 400px" name="description"></textarea>
                    <label for="floatingTextarea2">Descrizione</label>
                  </div>
            </div>

            <div class="mb-3 col-3">
                <label for="price_per_day" class="form-label">Prezzo</label>
                <input type="number" class="form-control" id="price" name="price_per_day" step="0.1">
              </div>
        
            <div class="mb-3 col-3">
                <label for="room_number" class="form-label">Camere</label>
                <input type="number" class="form-control" id="room_number" name="room_number" step="1">
              </div>

            <div class="mb-3 col-3">
                <label for="bed_number" class="form-label">Letti</label>
                <input type="number" class="form-control" id="bed_number" name="bed_number" step="1">
              </div>

            <div class="mb-3 col-3">
                <label for="bathroom_number" class="form-label">Bagni</label>
                <input type="number" class="form-control" id="bathroom_number" name="bathroom_number" step="1">
              </div>

            <div class="mb-3 col-3">
                <label for="square_mt" class="form-label">Dimensione</label>
                <input type="number" class="form-control" id="square_mt" name="square_mt" step="5">
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
          </form>
        </div>
</div>