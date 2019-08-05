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

@if($donation)
    <div class="row new-donation-form primary-1">
        <form method="POST" action="{{ url('celo/' . $donation->id) }}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="reason" value="user-deleted">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="form-group">
                    <p class="text-center">
                        (HAI CAMBIATO IDEA?)
                    </p>
                    <div>
                        <button class="button" type="submit">
                            <span>Clicca qui per eliminare la tua donazione</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br/>
    <br/>
@endif

<div class="row new-donation-form primary-1">
    {!! BootForm::vertical(['model' => $donation, 'store' => 'DonationController@store', 'update' => 'DonationController@update', 'enctype' => 'multipart/form-data']) !!}
        <div class="col-md-12">
            @include('call.selector', [
                'call' => $call,
                'donation' => $donation,
                'call_type' => 'service',
                'direct_response' => false
            ])

            <input type="hidden" name="type" value="service">

            @include('category.selector', [
                'orientation' => 'horizontal',
                'selected' => $donation ? $donation->category_id : null,
                'type' => 'service',
                'direct_response' => false
            ])

            {!! BootForm::text('title', 'Cosa offro', null, ['required' => 'required']) !!}
            {!! BootForm::textarea('description', 'Descrizione', null, ['required' => 'required']) !!}
            {!! BootForm::date('since', 'Disponibile da', date('Y-m-d')) !!}

            <br><br><br>

            {!! BootForm::text('name', 'Nome', $currentuser->name, ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', $currentuser->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo') !!}
            {!! BootForm::text('phone', 'Telefono', $currentuser->phone, ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', $currentuser->email, ['required' => 'required']) !!}

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
