@foreach ($flats as $flat)
    <p>{{ $flat->title }}</p>
    <p>{{ $flat->room_number }}</p>
@endforeach


<header>
        <h1>Lista Camere</h1>
    </header>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Numero Camere</th>
                <th scope="col">Numeri Letti </th>
                <th scope="col">Numeri bagni </th>
                <th scope="col">Indirizzo</th>
                 <th scope="col">Latitudine</th>
                  <th scope="col">Longitudine</th>
                     <th scope="col">Visibile</th>
                <th>Bottoni</th>

            </tr>
        </thead>
        <tbody>
            @forelse($flats as $flat)
                <tr>
                    <th scope="row">{{ $flat->id }}</th>
                    <td>{{ $flat->title }}</td>
                    <td>{{ $flat->room_number }}</td>
                    <td>{{ $flat->bed_number}}</td>
                    <td>{{ $flat->bathroom_number }}</td>
                    <td>{{ $flat->address }}</td>
                    <td>{{ $flat->latitude }}</td>
                    <td>{{ $flat->longitude }}</td>
                    <td>{{ $flat->visible}}</td>

                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <h3 class="text-center">Nessun appartamento</h3>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>