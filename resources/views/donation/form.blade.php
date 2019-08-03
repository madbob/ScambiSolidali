<?php

if (isset($call) == false)
    $call = false;
if (isset($donation) == false)
    $donation = null;

?>

{!! BootForm::horizontal(['model' => $donation, 'store' => 'DonationController@store', 'update' => 'DonationController@update', 'enctype' => 'multipart/form-data']) !!}
    @if($call != null)
        <br/>
        <div class="alert alert-info">
            <input type="hidden" name="call_id" value="{{ $call->id }}">
            <p>Stai rispondendo all'appello "{{ $call->title }}" di {{ printableDate($call->created_at) }}</p>
        </div>
        <br/>
    @endif

    <div class="page-header">
        <h4>Informazioni sull'Oggetto</h4>
    </div>

    @include('category.selector', [
        'orientation' => 'horizontal',
        'type' => $call->type,
        'direct_response' => false
    ])

    {!! BootForm::text('title', 'Oggetto', null, ['required' => 'required']) !!}
    {!! BootForm::textarea('description', 'Descrizione e Dimensioni', null, ['required' => 'required']) !!}

    <div class="form-group ">
        <label for="photo" class="control-label col-sm-2 col-md-3">Foto</label>
        <div class="col-sm-10 col-md-9 many-rows">
            @if($donation)
                @for($i = 1; $i <= $donation->imagesNum(); $i++)
                    <div class="single-row static-row">
                        <div class="col-sm-8">
                            <input name="keep_photo[]" type="hidden" value="{{ $i }}">
                            <img src="{{ $donation->imageUrl($i) }}" class="img-responsive" />
                        </div>
                        <button class="btn btn-danger delete-many-rows"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    </div>
                @endfor
            @endif

            <div class="single-row">
                <div class="col-sm-8">
                    <input class="form-control filestyle" name="photo[]" type="file" {{ $donation == null ? 'required="required"' : '' }}>
                    <img src="#" />
                </div>
            </div>

            <div class="col-sm-12">
                <button class="btn btn-info add-many-rows"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
                <span class="help-block">
                    È richiesta almeno una foto, opzionalmente puoi caricarne altre.
                </span>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h4>Informazioni per il Ritiro</h4>
    </div>

    <?php $last = $donation ? $donation : $currentuser->lastDonation() ?>

    {!! BootForm::text('name', 'Nome', $last ? $last->name : $currentuser->name, ['required' => 'required']) !!}
    {!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $currentuser->surname, ['required' => 'required']) !!}
    {!! BootForm::text('address', 'Indirizzo', $last ? $last->address : '', ['required' => 'required']) !!}
    {!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $currentuser->phone, ['required' => 'required']) !!}
    {!! BootForm::email('email', 'E-Mail', $last ? $last->email : $currentuser->email, ['required' => 'required']) !!}
    {!! BootForm::text('floor', 'Piano', $last ? $last->floor : '') !!}
    {!! BootForm::checkbox('elevator', 'Ascensore', $last ? $last->elevator : false) !!}
    {!! BootForm::textarea('shipping_notes', 'Note') !!}
    {!! BootForm::checkbox('autoship', 'Lo posso trasportare io', 'autoship', null) !!}

    @if($donation)
        {!! BootForm::submit('Salva Annuncio') !!}
    @else
        {!! BootForm::submit('Invia Annuncio') !!}
    @endif

{!! BootForm::close() !!}
