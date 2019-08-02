<p>
    La tua donazione su {{ env('APP_NAME') }} ("{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}) è stata assegnata
    @if($institute)
        da {{ $institute->name }}
    @endif
    !
</p>
@if(!empty($message))
    <p>
        L'assegnatario scrive il seguente messaggio:<br>
        {!! nl2br($message) !!}
    </p>
    <p>
        Puoi ricontattarlo all'indirizzo email {{ $user->email }} o al numero di telefono {{ $user->phone }}.
    </p>
@else
    <p>
        Verrai a breve contattato per avere maggiori informazioni sul recupero. Per informazioni e contatti, scrivi all'indirizzo {{ $user->email }}.
    </p>
@endif
