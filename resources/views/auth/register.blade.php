@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3 primary-1">
        {!! BootForm::open(['left_column_class' => 'col-md-4', 'left_column_offset_class' => 'col-md-offset-4', 'right_column_class' => 'col-md-8', 'action' => 'Auth\RegisterController@register']) !!}
            {!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}
            {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
            {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}

            <div class="form-group">
                <div>
                    <button class="button" type="submit">
                        <span>Registrati</span>
                    </button>
                </div>
            </div>
        {!! BootForm::close() !!}

        <p>
            Hai un codice identificativo per accreditarti come operatore? <a href="{{ url('register/operator') }}">Visita questa pagina</a>.
        </p>
    </div>
</div>

@endsection
