<p>
    È stato richiesto il trasporto per il ritiro di una donazione su {{ env('APP_NAME') }}.
</p>
<p>
    {{ $donation->title }}<br/>
    Indirizzo: {{ $donation->address }}<br/>
    Telefono: {{ $donation->phone }}<br/>
    @if(!empty($donation->floor))
        Piano: {{ $donation->floor }}<br/>
    @endif
    Ascensore: {{ $donation->elevator ? 'si' : 'no' }}
</p>
<p>
    Contatta il richiedente ({{ $user->email }} - {{ $user->phone }}) per ulteriori informazioni.
</p>
