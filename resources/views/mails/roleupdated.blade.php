<p>
    Il tuo account su {{ env('APP_NAME') }} è stato aggiornato al ruolo di "{{ $user->role_name }}".
</p>

@if($user->role == 'operator' || $user->role == 'student')
    @if($user->role == 'operator')
        <p>
            Ora puoi accedere a tutte le donazioni ed assegnarle.
        </p>
    @else
        <p>
            Ora puoi accedere a tutte le donazioni ed assegnartele.
        </p>
    @endif

    <p>
        Ricorda di tenere in ordine le informazioni su {{ env('APP_NAME') }}: se rinunci ad una donazione precedentemente assegnata marcarla come nuovamente disponibile per gli altri, e segnala donazioni non congrue con la descrizione affinché siano esaminate ed eventualmente rimosse.
    </p>
@endif
