@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3 primary-1">
        {!! BootForm::open(['url' => url('/password/email'), 'left_column_class' => 'col-md-4', 'right_column_class' => 'col-md-8']) !!}
            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}

            <div class="form-group">
                <div>
                    <button class="button" type="submit">
                        <span>Chiedi Reset Password</span>
                    </button>
                </div>
            </div>

            <a class="btn btn-link pull-right" href="{{ url('/register') }}">Registrati Qui!</a>
            <a class="btn btn-link" href="{{ url('/login') }}">Login</a>
        {!! BootForm::close() !!}
    </div>
</div>

@endsection
