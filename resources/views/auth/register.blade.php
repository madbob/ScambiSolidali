@extends('layouts.app')

@section('content')

<div class="row justify-content-center my-5">
    <div class="register-form col-md-6 primary-1">
        <x-larastrap::form route="register" :buttons="['element' => 'larastrap::sbtn', 'label' => 'Registrati', 'attributes' => ['type' => 'submit']]">
            <x-larastrap::text name="name" label="Nome" required />
            <x-larastrap::text name="surname" label="Cognome" required />
            <x-larastrap::email name="email" label="E-Mail" required />
            <x-larastrap::text name="phone" label="Telefono" required />

            @if(env('HAS_BIRTHDATE', false))
                <x-larastrap::date name="birthdate" label="Data di Nascita" />
            @endif

            <x-larastrap::password name="password" label="Password" required />
            <x-larastrap::password name="password_confirmation" label="Conferma Password" required />

			@if(App\Config::getConf('explicit_zones') == 'true')
                <-larastrap::radios name="area" label="Area" :options="App\Donation::areas()" />
			@endif

            <x-larastrap::text name="check" :label="sprintf('Quanto fa %s', genCaptcha())" required />

            @if(env('HAS_PUBLIC_OP', false))
                <x-larastrap::check inline name="public_op" value="1" label="Richiedo l'accesso per ottenere i beni donati su CeloCelo. Le richieste saranno vagliate dagli amministratori." />
            @endif

            <x-larastrap::check inline name="privacy" value="privacy" :label_html="sprintf('Ho letto ed accetto <a href=\'%s\'>l\'informativa sulla privacy e le condizioni d\'uso del servizio</a>', route('pages.privacy'))" required />
        </x-larastrap::form>

        <br/>

        <p>
            Hai un codice identificativo per accreditarti come {{ App\User::existingRoles()['operator']->label }}?<br/>
            <a href="{{ route('register.operator') }}">Visita questa pagina</a>.
        </p>
    </div>
</div>

@endsection
