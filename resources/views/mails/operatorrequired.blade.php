<p>
    Richiesto nuovo accesso come operatore da parte di {{ $user->printableName() }} ({{ $user->email }}).
</p>
<p>
    Per abilitarlo, <a href="{{ route('utenti.show', $user->id) }}">clicca qui</a> e cambia il "Ruolo" dell'utente in "Operatore".
</p>
