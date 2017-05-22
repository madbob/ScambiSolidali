<p>
    La tua donazione su {{ env('APP_NAME') }} ("{{ $donation->title }}" del {{ date('d/m/y', strtotime($donation->created_at)) }}) è stata assegnata!
</p>
<p>
    Verrai a breve contattato per avere maggiori informazioni sul recupero.
</p>
