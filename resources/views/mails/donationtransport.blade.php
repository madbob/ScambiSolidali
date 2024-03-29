<p>
    È stato richiesto il trasporto per il ritiro di una donazione su {{ env('APP_NAME') }}.
</p>
<p>
    {{ $donation->title }}<br/>
    Nome: {{ $donation->user->printableName() }}<br/>
    Indirizzo: {{ $donation->address }}<br/>
    Telefono: {{ $donation->phone }}<br/>
    @if(!empty($donation->floor))
        Piano: {{ $donation->floor }}<br/>
    @endif
    Ascensore: {{ $donation->elevator ? 'si' : 'no' }}
</p>
<p>
    Destinazione:<br>
    Nome: {{ $receiver->shipping_name }}<br>
    Indirizzo: {{ $receiver->shipping_address }}<br>
    Piano: {{ $receiver->shipping_floor }}<br>
    Ascensore: {{ $receiver->shipping_elevator ? 'si' : 'no' }}<br>
    Telefono: {{ $receiver->shipping_phone }}
</p>
<p>
    Contatta il richiedente ({{ $user->email }} - {{ $user->phone }}) per ulteriori informazioni.
</p>
