<p>
    La tua donazione su {{ env('APP_NAME') }} ("{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}) purtroppo non è ancora stata assegnata e sta per scadere.
</p>
<p>
    <a href="{!! url('celo/renew/' . urlencode(base64_encode(sprintf('%d-%d', $donation->id, $donation->user->id)))) !!}">Clicca qui</a> per rinnovare l'annuncio di altri due mesi, oppure tra una settimana sarà automaticamente rimosso.
</p>
