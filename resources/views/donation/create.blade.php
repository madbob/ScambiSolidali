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
        <div class="col-md-3">
            @if($donation)
                @for($i = 1; $i <= $donation->imagesNum(); $i++)
                    <div class="common-card">
                        <div class="card-main vert-align image-frame bg-white txt-color" style="background-image: url('{{ $donation->imageUrl($i) }}')">
                        </div>
                        <div class="card-footer vert-align">
                            <p class="removefile">
                                RIMUOVI FOTO
                            </p>
                        </div>

                        <input type="hidden" name="keep_photo[]" value="{{ $i }}">
                    </div>
                    <br/>
                @endfor
            @endif

            <div class="common-card fileuploader">
                <div class="card-main vert-align image-frame bg-white txt-color">
                    <p>
                        <canvas id="preview-canvas" height="0" width="0"></canvas>
                    </p>
                </div>
                <div class="card-footer vert-align">
                    <p>
                        CARICA FOTO
                    </p>
                </div>

                <input type="file" name="photo[]" class="hidden">
            </div>
        </div>

        <div class="col-md-8 col-md-offset-1">
            @include('call.selector', [
                'call' => $call,
                'donation' => $donation,
                'call_type' => 'object',
                'direct_response' => false
            ])

            <input type="hidden" name="type" value="object">

            {!! BootForm::text('title', 'Il mio Oggetto', null, ['required' => 'required']) !!}

            @include('category.selector', ['orientation' => 'horizontal', 'selected' => $donation ? $donation->category_id : null, 'type' => 'object'])

            {!! BootForm::textarea('description', 'Descrizione', null, ['required' => 'required']) !!}
            {!! BootForm::text('size', 'Dimensioni', null) !!}
            {!! BootForm::date('since', 'Disponibile da', date('Y-m-d')) !!}

            <br><br><br>

            <?php $last = $donation ? $donation : $currentuser->lastDonation() ?>

            {!! BootForm::text('name', 'Nome', $last ? $last->name : $currentuser->name, ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $currentuser->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo (via, numero civico, CAP, città)', $last ? $last->address : '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $currentuser->phone, ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', $last ? $last->email : $currentuser->email, ['required' => 'required']) !!}
            {!! BootForm::text('floor', 'Piano', $last ? $last->floor : '') !!}

            <div class="checkbox checkbox-custom">
				<input id="elevator" type="checkbox" name="elevator" {{ $last && $last->elevator ? 'checked' : '' }}>
				<label for="elevator">C'è l'ascensore</label>
			</div>

            {!! BootForm::textarea('shipping_notes', 'Note') !!}

            <div class="checkbox checkbox-custom">
				<input id="autoship" type="checkbox" name="autoship">
				<label for="autoship">Lo posso trasportare io</label>
			</div>

            <br/>

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
