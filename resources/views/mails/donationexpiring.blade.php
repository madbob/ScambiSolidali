<p>
    La tua donazione su {{ env('APP_NAME') }} ("{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}) purtroppo non è ancora stata assegnata e sta per scadere.
</p>
<p>
    <a href="{{ route('celo.renew', ['token' => $donation->renewToken()]) !!}">Clicca qui</a> per rinnovare l'annuncio di altri due mesi, oppure tra una settimana sarà automaticamente rimosso.
</p>
