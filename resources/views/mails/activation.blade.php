<p>
    Ti sei registrato su {{ env('APP_NAME') }}.
</p>
<p>
    Per confermare il tuo account, visita il seguente link:<br/>
    <a href="{{ $link = url('register/activate', $user->verification_code) }}">{{ $link }}</a>
</p>
<p>
	Il link sopra è valido una sola volta. Una volta confermato, potrai accedere da questo link:<br/>
	<a href="{{ $link = route('login') }}">{{ $link }}</a><br/>
	specificando il tuo indirizzo email e la tua password.
</p>
