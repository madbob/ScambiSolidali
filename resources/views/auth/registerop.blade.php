@extends('layouts.app')

@section('content')

<div class="row">
    <div class="register-form col-md-6 col-md-offset-3 primary-1">
        {!! BootForm::open(['left_column_class' => 'col-md-4', 'left_column_offset_class' => 'col-md-offset-4', 'right_column_class' => 'col-md-8', 'action' => 'Auth\RegisterController@registerOp']) !!}
            {!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}
            {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
            {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}
            {!! BootForm::text('code', 'Codice', '', ['required' => 'required', 'help_text' => 'Qui devi immettere il codice identificativo fornito dagli amministratori della piattaforma']) !!}
            {!! BootForm::text('check', 'Quanto fa ' . genCaptcha(), '', ['required' => 'required']) !!}

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
    </div>
</div>

@endsection
