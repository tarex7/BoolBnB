@component('mail::message')
    # Introduction

    {{ $message }}


    {{-- rispondi --}}

    <a href="mailto:{{ $sender }}">Rispondi</a>
    s
    {{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}



    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
