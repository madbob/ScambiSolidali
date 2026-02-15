@extends('layouts.app')

@section('title', 'Grazie!')

@section('content')
    <div class="row primary-1">
        <div class="col">
            <h2 class="mb-5">
                Grazie per aver inserito il tuo annuncio!<br/>
                Verrai contattato nel momento in cui qualcuno sarà interessato al tuo oggetto o alla tua competenza.
            </h2>

            <p class="mb-5">
                Ricorda che l'annuncio ha validità di {{ App\Config::getConf('expiration') }} mesi, passati i quali riceverai una mail per rinnovarlo.
            </p>

            @if(isset($donation) && $donation->type == 'object')
                <p class="lead">
                    Se nel frattempo trovi un altro destinatario, ricorda di annullare l'annuncio <a href="{{ route('donation.mine') }}">dal pannello delle tue donazioni</a>!
                </p>
            @endif

            <p>
                <a class="dense-button" href="{{ url('/') }}">
                    <span>Torna alla homepage</span>
                </a>
                <br/>
                <a class="dense-button" href="{{ route('donation.mine') }}">
                    <span>Consulta le tue Donazioni</span>
                </a>
            </p>
        </div>
    </div>
@endsection
