@extends('layouts.app')

@section('content')

<div class="row justify-content-center my-5">
    <div class="col-md-6 primary-1">
        <x-larastrap::form route="password.update" :buttons="[['element' => 'larastrap::sbtn', 'label' => 'Resetta Password']]">
            <x-larastrap::hidden name="token" :value="$token" />
            <x-larastrap::email name="email" label="E-Mail" required />
            <x-larastrap::password name="password" label="Password" required />
            <x-larastrap::password name="password_confirmation" label="Conferma Password" required />
        </x-larastrap::form>
    </div>
</div>

@endsection
