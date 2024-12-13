@extends('layouts.app')

@section('content')

<div class="row justify-content-center my-5">
    <div class="register-form col-md-6 primary-1">
        <x-larastrap::form route="register.operator" :buttons="['element' => 'larastrap::sbtn', 'label' => 'Registrati', 'attributes' => ['type' => 'submit']]">
            <x-larastrap::text name="name" label="Nome" required />
            <x-larastrap::text name="surname" label="Cognome" required />
            <x-larastrap::email name="email" label="E-Mail" required />
            <x-larastrap::text name="phone" label="Telefono" required />
            <x-larastrap::password name="password" label="Password" required />
            <x-larastrap::password name="password_confirmation" label="Conferma Password" required />
            <x-larastrap::text name="code" label="Codice" required help="Qui devi immettere il codice identificativo fornito dagli amministratori della piattaforma" />
            <x-larastrap::text name="check" :label="sprintf('Quanto fa %s', genCaptcha())" required />

            <x-larastrap::check inline name="privacy" value="privacy" :label_html="sprintf('Ho letto ed accetto <a href=\'%s\'>l\'informativa sulla privacy e le condizioni d\'uso del servizio</a>', route('pages.privacy'))" required />
        </x-larastrap::form>
    </div>
</div>

@endsection
