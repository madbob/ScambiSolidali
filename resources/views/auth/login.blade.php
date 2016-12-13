@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-6">
                <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                                {!! BootForm::open(['left_column_class' => 'col-md-4', 'right_column_class' => 'col-md-8']) !!}
                                        {!! BootForm::hidden('remember', 1) !!}
                                        {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
                                        {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
										{!! BootForm::submit('Login') !!}
										<a class="btn btn-link" href="{{ url('/password/reset') }}">Password Dimenticata?</a>
                                {!! BootForm::close() !!}
                        </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="panel panel-default">
                        <div class="panel-heading">Registrati</div>
                        <div class="panel-body">
                                {!! BootForm::open(['left_column_class' => 'col-md-4', 'left_column_offset_class' => 'col-md-offset-4', 'right_column_class' => 'col-md-8', 'action' => 'Auth\RegisterController@register']) !!}
                                        {!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
                                        {!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
                                        {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
                                        {!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}
                                        {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
                                        {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}
                                        {!! BootForm::submit('Registrati') !!}
                                {!! BootForm::close() !!}
                        </div>
                </div>
        </div>
</div>

@endsection
