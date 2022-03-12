@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3 primary-1">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            {!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
            {!! BootForm::password('password', 'Password', ['required' => 'required']) !!}
            {!! BootForm::password('password_confirmation', 'Conferma Password', ['required' => 'required']) !!}

            <div class="form-group">
                <div>
                    <button class="button" type="submit">
                        <span>Resetta Password</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
