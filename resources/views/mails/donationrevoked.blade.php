<p>
    L'assegnazione della tua donazione su {{ env('APP_NAME') }} ("{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}) è stata revocata.
</p>
<p>
    La tua donazione è tornata a disposizione degli operatori della piattaforma, sarai ulteriormente notificato in caso di nuova assegnazione.
</p>
