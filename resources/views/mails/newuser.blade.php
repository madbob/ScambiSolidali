<p>
    Sei stato invitato a partecipare a {{ env('APP_NAME') }}.
</p>
<p>
    Per autenticarti, visita il sito {{ env('APP_URL') }} ed accedi con le
    seguenti credenziali:<br>
    Username: {{ $user->email }}<br>
    Password: {{ $password }}
</p>
