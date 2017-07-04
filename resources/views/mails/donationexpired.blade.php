<p>
    C'è una nuova donazione scaduta e recuperabile su {{ env('APP_NAME') }}: "{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}.
</p>
<p>
    <a href="{!! url('/celo/?show=' . $donation->id) !!}">Clicca qui</a> per vedere i dettagli e, all'occorrenza, recuperarla.
</p>
<p>
    Tra sette giorni la donazione sarà automaticamente scartata.
</p>
