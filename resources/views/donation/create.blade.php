@extends('layouts.app')

@section('title', 'Celo')

@section('content')
<div class="row new-donation-form primary-1">
    {!! BootForm::vertical(['action' => 'DonationController@store', 'enctype' => 'multipart/form-data']) !!}
        <div class="col-md-3">
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

                <input type="file" name="" class="hidden">
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

            {!! BootForm::text('title', 'Il mio Oggetto', null, ['required' => 'required']) !!}

            <div class="form-group">
                <label for="category_id" class="col-sm-2 col-md-3 control-label">Categoria</label>
                <div class="col-sm-10 col-md-9">
                    @include('category.selector', ['orientation' => 'horizontal', 'selected' => null])
                </div>
            </div>

            {!! BootForm::textarea('description', 'Come è fatto', null, ['required' => 'required']) !!}

            <?php $last = Auth::user()->lastDonation() ?>

            {!! BootForm::text('name', 'Nome', $last ? $last->name : $user->name, ['required' => 'required']) !!}
            {!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $user->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo', $last ? $last->address : '', ['required' => 'required']) !!}
            {!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $user->phone, ['required' => 'required']) !!}
            {!! BootForm::email('email', 'E-Mail', $last ? $last->email : $user->email, ['required' => 'required']) !!}
            {!! BootForm::text('floor', 'Piano', $last ? $last->floor : '') !!}
            {!! BootForm::checkbox('elevator', 'Ascensore', $last ? $last->elevator : false) !!}
            {!! BootForm::textarea('shipping_notes', 'Note') !!}
            {!! BootForm::checkbox('autoship', 'Lo posso trasportare io', 'autoship', null, ['help_text' => 'Bla Bla Bla se puoi consegnarlo tu Bla Bla Bla']) !!}
            {!! BootForm::checkbox('recoverable', 'Recupera Oggetto', 'recoverable', null, ['help_text' => 'Bla Bla Bla Cooperativa Triciclo Bla Bla Bla']) !!}

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
