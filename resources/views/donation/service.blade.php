@extends('layouts.app')

@section('title', 'Celo')

@section('content')

<?php

if (isset($call) == false)
    $call = null;

if (isset($donation) == false)
    $donation = null;
else
    $call = $donation->call;

?>

<div class="row new-donation-form primary-1">
    {!! BootForm::vertical(['model' => $donation, 'store' => 'DonationController@store', 'update' => 'DonationController@update', 'enctype' => 'multipart/form-data']) !!}
        <div class="col-md-12">
            @if($call != null)
                <br/>
                <div class="alert alert-info">
                    <input type="hidden" name="call_id" value="{{ $call->id }}">
                    <p>Stai rispondendo all'appello "{{ $call->title }}" di {{ printableDate($call->created_at) }}</p>
                </div>
                <br/>
            @endif

            <input type="hidden" name="type" value="service">

            {!! BootForm::text('title', 'Cosa faccio', null, ['required' => 'required']) !!}
            {!! BootForm::textarea('description', 'Descrizione', null, ['required' => 'required']) !!}
            {!! BootForm::text('name', 'Nome', $user->name, ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', $user->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo') !!}
            {!! BootForm::text('phone', 'Telefono', $user->phone, ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', $user->email, ['required' => 'required']) !!}

            <div class="form-group">
                <p class="text-center">
                    (HAI SCRITTO TUTTO TUTTO?)
                </p>
                <div>
                    <button class="button" type="submit">
                        <span>Allora clicca qui!</span>
                    </button>
                </div>
            </div>
        </div>
    {!! BootForm::close() !!}
</div>
@endsection
