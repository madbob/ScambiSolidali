@extends('layouts.app')

@section('title', 'Grazie!')

@section('content')
    <div class="row primary-1">
        <div class="col-md-12">
            <h2>
                Grazie per aver inserito il tuo annuncio!<br/>
                Verrai contattato nel momento in cui qualcuno sarà interessato al tuo oggetto o alla tua competenza.
            </h2>

            <br><br><br>

            @if($donation->type == 'object')
                <p>
                    Se nel frattempo trovi un altro destinatario, ricorda di annullare l'annuncio <a href="{{ url('donazione/mie') }}">dal pannello delle tue donazioni</a>!
                </p>
            @endif

            <p>
                <a class="dense-button" href="{{ url('/') }}">
                    <span>Torna alla homepage</span>
                </a>
                <br/>
                <a class="dense-button" href="{{ url('donazione/mie') }}">
                    <span>Consulta le tue Donazioni</span>
                </a>
            </p>
        </div>
    </div>
@endsection
