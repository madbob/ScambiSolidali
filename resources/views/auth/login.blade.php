@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3 primary-1">
        {!! BootForm::open(['left_column_class' => 'col-md-4', 'right_column_class' => 'col-md-8']) !!}
            {!! BootForm::hidden('remember', 1) !!}
            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
            {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}

            <div class="form-group">
                <div>
                    <button class="button" type="submit">
                        <span>Login</span>
                    </button>
                </div>
            </div>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">Password Dimenticata?</a>
        {!! BootForm::close() !!}
    </div>
</div>

@endsection
