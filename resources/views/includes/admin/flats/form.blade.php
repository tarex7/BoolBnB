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
        
            <div class="mb-3 form-check col-6">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
</div>