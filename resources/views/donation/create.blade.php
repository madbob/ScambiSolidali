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
			<div class="page-header">
				<h4>Informazioni sull'Oggetto</h4>
			</div>

			<div class="form-group">
				<label for="category_id" class="col-sm-2 col-md-3 control-label">Categoria</label>
				<div class="col-sm-10 col-md-9">
					@include('category.selector', ['orientation' => 'horizontal'])
				</div>
			</div>

			{!! BootForm::text('title', 'Oggetto') !!}
			{!! BootForm::file('photo', 'Foto') !!}
			{!! BootForm::textarea('description', 'Descrizione') !!}

			<div class="page-header">
				<h4>Informazioni per il Ritiro</h4>
			</div>

			<?php $last = Auth::user()->lastDonation() ?>

			{!! BootForm::text('name', 'Nome', $last ? $last->name : $user->name) !!}
			{!! BootForm::text('surname', 'Cognome', $last ? $last->surname : $user->surname) !!}

            <div class="form-group">
				<label for="category_id" class="col-sm-2 col-md-3 control-label">Indirizzo</label>
				<div class="col-sm-10 col-md-9">
                    <input type="hidden" name="address" value="{{ $last ? $last->address : '' }}">
                    <input type="hidden" name="coordinates" value="{{ $last ? ($last->lat + ',' + $last->lng) : '' }}">
					<div id="map-select"></div>
				</div>
			</div>

			{!! BootForm::text('phone', 'Telefono', $last ? $last->phone : $user->phone) !!}
			{!! BootForm::email('email', 'E-Mail', $last ? $last->email : $user->email) !!}
			{!! BootForm::textarea('shipping_notes', 'Note') !!}
			{!! BootForm::checkbox('recoverable', 'Recupera Oggetto', 'recoverable', false, ['help_text' => 'Bla Bla Bla Cooperativa Triciclo Bla Bla Bla']) !!}

			{!! BootForm::submit('Invia Segnalazione') !!}
		{!! BootForm::close() !!}
	</div>
</div>
@endsection
