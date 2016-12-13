<p>
    La tua donazione su {{ env('APP_NAME') }} ha trovato un destinatario!
</p>
<p>
    Ti invitiamo ad accedere a questa pagina<br>
    {{ url('/donazione/' . $donation->uuid . '/edit') }}<br>
    per comunicarci le tue disponibilità per il ritiro.
</p>
