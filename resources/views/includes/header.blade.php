<header>
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center py-4">
            <img class="img fluid col-2" src={{ asset('images/logo.png') }} alt="logo Air BnB">
            <nav>
                <ul>
                    {{-- <li class="fw-bold"><a>Characters</a></li>
                    <li class="fw-bold"><a href="#">Comics</a></li>
                    <li class="fw-bold"><a>Movies</a></li>
                    <li class="fw-bold"><a>Tv</a></li>
                    <li class="fw-bold"><a>Games</a></li>
                    <li class="fw-bold"><a>Collectibles</a></li>
                    <li class="fw-bold"><a>Videos</a></li>
                    <li class="fw-bold"><a>Fans</a></li>
                    <li class="fw-bold"><a>News</a></li>
                    <li class="fw-bold"><a>Shop</a></li> --}}
                </ul>
            </nav>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <h1>I tuoi appartamenti</h1>
    
    
            <div class="d-flex justify-content-end align-items-center">
    
    
                {{-- Add new Flat --}}
                <a class='btn btn-success'href="{{ route('admin.flats.create') }}">
                    <i class='fa-solid fa-plus mr-2'></i> Nuovo
                    Appartamento</a>
    
                <div>
                </div>
            </div>
    
        </div>
    </div>
</header>