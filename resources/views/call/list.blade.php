@extends('layouts.admin')

@section('title', 'Appelli')

@section('acontent')
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default" data-toggle="modal" data-target="#new-call">Crea Nuovo Appello</button>
		</div>
	</div>

	<div class="modal fade" id="new-call" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Crea Nuovo Appello</h4>
				</div>

				{!! BootForm::horizontal(['action' => 'CallController@store']) !!}
					<div class="modal-body">
						{!! BootForm::text('title', 'Titolo', '', ['required' => 'required']) !!}
                        {!! BootForm::textarea('who', 'Chi siamo?') !!}
                        {!! BootForm::textarea('what', 'Cosa vogliamo?') !!}
                        {!! BootForm::textarea('whom', 'Per chi?') !!}
                        {!! BootForm::text('when', 'Per quando?', '', ['class' => 'date']) !!}
                        {!! BootForm::radios('status', 'Stato', [
                            'draft' => 'Bozza (non visibile pubblicamente)',
                            'open' => 'Pubblicato',
                            'archived' => 'Archiviato',
                        ]) !!}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
						<button type="submit" class="btn btn-primary">Salva</button>
					</div>
				{!! BootForm::close() !!}
			</div>
		</div>
	</div>

	<hr/>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>Titolo</th>
						<th>Data Creazione</th>
                        <th>Data Chiusura</th>
						<th>Stato</th>
                        <th>Azioni</th>
					</tr>
				</thead>
				<tbody>
					@foreach($calls as $call)
						<tr>
							<td>{{ $call->title }}</td>
							<td>{{ printableDate($call->created_at) }}</td>
                            <td>{{ printableDate($call->when) }}</td>
							<td>
                                @if($call->status == 'draft')
                                    <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>
                                @elseif($call->status == 'open')
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                @elseif($call->status == 'archived')
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                @endif
                            </td>
                            <td><button class="btn btn-default show-details" data-endpoint="appello" data-item-id="{{ $call->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{ $calls->links() }}
		</div>
	</div>
@endsection
