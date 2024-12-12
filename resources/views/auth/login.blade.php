@extends('layouts.app')

@section('content')

<div class="row justify-content-center my-5">
    <div class="col-md-6 primary-1">
        <x-larastrap::form route="login" :buttons="['element' => 'larastrap::sbtn', 'label' => 'Login', 'attributes' => ['type' => 'submit']]">
            <x-larastrap::hidden name="remember" value="1" />
            <x-larastrap::email name="email" label="E-Mail" required />
            <x-larastrap::password name="password" label="Password" required />

            <a class="btn btn-link px-0 float-end" href="{{ route('register') }}">Registrati Qui!</a>
            <a class="btn btn-link px-0" href="{{ route('password.request') }}">Password Dimenticata?</a>
        </x-larastrap::form>
    </div>
</div>

@endsection
