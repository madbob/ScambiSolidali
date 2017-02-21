@extends('layouts.app')

@section('title', 'Dona')

@section('content')
<div class="row">
	<div class="col-md-12">
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, mauris vitae tristique laoreet, massa libero ultrices sem, eget ultricies nibh augue a nibh. Praesent eu vulputate enim. Donec volutpat eget nisl quis posuere. Praesent dapibus quam et arcu mattis hendrerit. Aliquam mattis quis nulla non viverra. Quisque id felis eu orci efficitur vehicula tincidunt ut elit. Donec magna mi, aliquet vitae malesuada sit amet, tempor nec quam. Morbi ultrices feugiat tellus at mattis. Nunc et viverra neque. Curabitur efficitur condimentum euismod. Vestibulum vel nunc ipsum.
		</p>
	</div>
</div>

<div class="row">
	<div class="col-md-12 new-donation-form">
		{!! BootForm::horizontal(['action' => 'DonationController@store', 'enctype' => 'multipart/form-data']) !!}
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

			<div class="form-group">
				<label for="category_id" class="col-sm-2 col-md-3 control-label">Categoria</label>
				<div class="col-sm-10 col-md-9">
					@include('category.selector', ['orientation' => 'horizontal'])
				</div>
			</div>

			{!! BootForm::text('title', 'Oggetto', '', ['required' => 'required']) !!}
			{!! BootForm::textarea('description', 'Descrizione', '', ['required' => 'required']) !!}

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 col-md-9 col-md-offset-3">
                    È richiesta almeno una foto, opzionalmente puoi caricarne altre.
                </div>
            </div>

            <div class="form-group ">
                <label for="photo" class="control-label col-sm-2 col-md-3">Foto</label>
                <div class="col-sm-10 col-md-9 many-rows">
                    <div class="single-row">
                        <div class="col-sm-8">
                            <input class="form-control filestyle" name="photo[]" type="file" required="required">
                        </div>
                    </div>

                    <button class="btn btn-info add-many-rows"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
                </div>
            </div>

			<div class="page-header">
				<h4>Informazioni per il Ritiro</h4>
			</div>

			<?php $last = Auth::user()->lastDonation() ?>

			{!! BootForm::text('name', 'Nome', $last ? $last->name : $user->name, ['required' => 'required']) !!}
			{!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $user->surname, ['required' => 'required']) !!}
            {!! BootForm::text('address', 'Indirizzo', $last ? $last->address : '', ['required' => 'required']) !!}
			{!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $user->phone, ['required' => 'required']) !!}
			{!! BootForm::email('email', 'E-Mail', $last ? $last->email : $user->email, ['required' => 'required']) !!}
            {!! BootForm::text('floor', 'Piano', $last ? $last->floor : '') !!}
            {!! BootForm::checkbox('elevator', 'Ascensore', $last ? $last->elevator : false) !!}
			{!! BootForm::textarea('shipping_notes', 'Note') !!}
			{!! BootForm::checkbox('recoverable', 'Recupera Oggetto', 'recoverable', false, ['help_text' => 'Bla Bla Bla Cooperativa Triciclo Bla Bla Bla']) !!}

			{!! BootForm::submit('Invia Segnalazione') !!}
		{!! BootForm::close() !!}
	</div>
</div>
@endsection
