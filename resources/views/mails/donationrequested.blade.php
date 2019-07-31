<p>
    La tua donazione su {{ env('APP_NAME') }} ("{{ $user_message->donation->title }}" del {{ date('d/m/y', strtotime($user_message->donation->created_at)) }}) è stata richiesta da {{ $user_message->sender->printableName() }}!
</p>
<p>
    Messaggio allegato:<br>
    {!! nl2br($user_message->body) !!}
</p>
<p>
    Puoi ricontattare {{ $user_message->sender->printableName() }} tramite l'indirizzo email {{ $user_message->sender->email }} .
</p>
