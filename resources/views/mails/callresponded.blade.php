<p>
    Il tuo appello su {{ env('APP_NAME') }} ({{ $call->title }}) ha ricevuto una risposta!
</p>
@if(!empty($donation))
    <p>
        Ti invitiamo ad accedere a questa pagina<br>
        {!! url('/celo/?show=' . $donation->id) !!}<br>
        per verificare la donazione e rispondere al donatore ({{ $user->printableName() }} - {{ $user->email }} - {{ $user->phone }}).
    </p>
@else
    @if(!empty($message))
        {{ $user->printableName() }} - {{ $user->email }} - {{ $user->phone }} ha scritto:<br>
        {!! nl2br($message) !!}
    @endif
@endif
