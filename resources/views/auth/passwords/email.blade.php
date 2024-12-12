@extends('layouts.app')

@section('content')

<div class="row justify-content-center my-5">
    <div class="col-md-6 primary-1">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <x-larastrap::form route="password.email" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Chiedi Reset Password', 'attributes' => ['type' => 'submit']]]">
            <x-larastrap::email name="email" label="E-Mail" required />

            <a class="btn btn-link float-end" href="{{ route('register') }}">Registrati Qui!</a>
            <a class="btn btn-link" href="{{ route('login') }}">Login</a>
        </x-larastrap::form>
    </div>
</div>

@endsection
