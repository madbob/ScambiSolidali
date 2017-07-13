<p>
    Il tuo appello su {{ env('APP_NAME') }} ({{ $call->title }}) ha ricevuto una risposta!
</p>
<p>
    Ti invitiamo ad accedere a questa pagina<br>
    {!! url('/celo/?show=' . $donation->id) !!}<br>
    per verificare la donazione e rispondere al donatore.
</p>
