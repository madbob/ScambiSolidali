<p>
    La tua donazione su {{ env('APP_NAME') }} purtroppo non è ancora stata assegnata e sta per scadere.
</p>
<p>
    <a href="{!! url('celo/renew/' . urlencode(base64_encode(sprintf('%d-%d', $donation->id, $donation->user->id)))) !!}">Clicca qui</a> per rinnovare l'annuncio di un altro mese, oppure tra una settimana sarà automaticamente rimosso.
</p>
