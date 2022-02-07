<p>
    Il tuo appello su {{ env('APP_NAME') }} ("{{ $call->title }}" del {{ date('d/m/y', strtotime($call->created_at)) }}) è scaduto.
</p>
<p>
    <a href="{!! url('manca?show=' . $call->id) !!}">Clicca qui</a> per modificare l'appello ed impostare una diversa data di scadenza, o per metterlo in stato "Chiuso" se la tua richiesta è stata soddisfatta, oppure tra una settimana sarà automaticamente archiviato.
</p>
