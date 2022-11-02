@extends('layouts')
@section('title')
    Messaggi
@endsection
@section('content')
    <div class="container">
        <h1>Messaggi</h1>
        @foreach ($flats as $flat)
            <div>
                <h2>Appartamento "{{ $flat->title }}"</h2>
                @forelse ($flat->message as $message)
                    <div>
                        <p>Messaggio da: <i>{{ $message->sender_name }}</i></p>
                        <p>Email: { $message->sender_email }}</p>
                        <p>
                            {{ $message->text }}
                        </p>
                    </div>
                @empty
                    <h5>Nessun messaggio</h5>
                @endforelse
            </div>
        @endforeach
    </div>
