@extends('layouts.app')

@section('content')

<div class="row">
    <div class="register-form col-md-6 col-md-offset-3 primary-1">
        {!! BootForm::open(['left_column_class' => 'col-md-4', 'left_column_offset_class' => 'col-md-offset-4', 'right_column_class' => 'col-md-8', 'action' => 'Auth\RegisterController@register']) !!}
            {!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}

            @if(env('HAS_BIRTHDATE', false))
                {!! BootForm::date('birthdate', 'Data di Nascita', '') !!}
            @endif

            {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
            {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}

            {!! BootForm::text('check', genCaptcha(), '', ['required' => 'required']) !!}

            @if(env('HAS_PUBLIC_OP', false))
                <div class="form-group">
                    <label for="" class="control-label"></label>
                    <div>
                        <div class="checkbox">
                            <label>
                                <input name="public_op" value="1" type="checkbox">Richiedo l'accesso per ottenere i beni donati su CeloCelo. Le richieste saranno vagliate dagli amministratori.
                            </label>
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label for="" class="control-label"></label>
                <div>
                    <div class="checkbox">
                        <label>
                            <input name="privacy" value="privacy" type="checkbox">Ho letto ed accetto <a href="/privacy">l'informativa sulla privacy e le condizioni d'uso del servizio</a>
                        </label>
                    </div>
                </div>
            </div>

            <br/>

            <div class="form-group">
                <div>
                    <button class="button" type="submit">
                        <span>Registrati</span>
                    </button>
                </div>
            </div>
        {!! BootForm::close() !!}

        <br/>

        <p>
            Hai un codice identificativo per accreditarti come {{ App\User::existingRoles()['operator']->label }}?<br/><a href="{{ url('register/operator') }}">Visita questa pagina</a>.
        </p>
    </div>
</div>

@endsection
