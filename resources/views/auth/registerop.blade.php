@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Registrati come Operatore</div>
            <div class="panel-body">
                {!! BootForm::open(['left_column_class' => 'col-md-4', 'left_column_offset_class' => 'col-md-offset-4', 'right_column_class' => 'col-md-8', 'action' => 'Auth\RegisterController@registerOp']) !!}
                    {!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
                    {!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
                    {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
                    {!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}
                    {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
                    {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}
                    {!! BootForm::text('code', 'Codice', '', ['required' => 'required', 'help_text' => 'Qui devi immettere il codice identificativo fornito dagli amministratori della piattaforma']) !!}
                    {!! BootForm::submit('Registrati') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
