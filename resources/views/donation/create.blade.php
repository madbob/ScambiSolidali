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
        <div class="col-md-3">
            @if($donation)
                @for($i = 1; $i <= $donation->imagesNum(); $i++)
                    <div class="common-card fileuploader">
                        <div class="card-main vert-align image-frame bg-white txt-color" style="background-image: url('{{ $donation->imageUrl($i) }}')">
                        </div>
                        <div class="card-footer vert-align">
                            <p>
                                CARICA FOTO
                            </p>
                        </div>

                        <input type="hidden" name="keep_photo[]" value="{{ $i }}">
                    </div>
                @endfor
            @endif

            <div class="common-card fileuploader">
                <div class="card-main vert-align image-frame bg-white txt-color">
                    <p>
                        X
                    </p>
                </div>
                <div class="card-footer vert-align">
                    <p>
                        CARICA FOTO
                    </p>
                </div>

                <input type="file" name="photo[]" class="hidden" {{ $donation ? '' : 'required' }}>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-1">
            @if($call != null)
                <br/>
                <div class="alert alert-info">
                    <input type="hidden" name="call_id" value="{{ $call->id }}">
                    <p>Stai rispondendo all'appello "{{ $call->title }}" di {{ printableDate($call->created_at) }}</p>
                </div>
                <br/>
            @endif

            <input type="hidden" name="type" value="object">

            {!! BootForm::text('title', 'Il mio Oggetto', null, ['required' => 'required']) !!}

            <div class="form-group">
                <label for="category_id" class="col-sm-2 col-md-2 control-label">Categoria</label>
                <div class="col-sm-10 col-md-10">
                    @include('category.selector', ['orientation' => 'horizontal', 'selected' => $donation ? $donation->category_id : null])
                </div>
            </div>

            {!! BootForm::textarea('description', 'Descrizione', null, ['required' => 'required']) !!}

            <?php $last = $donation ? $donation : Auth::user()->lastDonation() ?>

            {!! BootForm::text('name', 'Nome', $last ? $last->name : $user->name, ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $user->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo', $last ? $last->address : '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $user->phone, ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', $last ? $last->email : $user->email, ['required' => 'required']) !!}
            {!! BootForm::text('floor', 'Piano', $last ? $last->floor : '') !!}
            {!! BootForm::checkbox('elevator', 'Ascensore', $last ? $last->elevator : false) !!}
            {!! BootForm::textarea('shipping_notes', 'Note') !!}
            {!! BootForm::checkbox('autoship', 'Lo posso trasportare io', 'autoship', null, ['help_text' => 'Bla Bla Bla se puoi consegnarlo tu Bla Bla Bla']) !!}
            {!! BootForm::checkbox('recoverable', "Se l'oggetto che hai inserito non viene richiesto da nessun operatore, passato un mese puoi scegliere di farlo valutare dalla cooperativa sociale Triciclo, nel caso in cui fossero interessati al tuo oggetto verrà preso in carico da loro.", 'recoverable', null) !!}

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
