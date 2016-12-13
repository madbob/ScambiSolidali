@extends('layouts.admin')

@section('title', 'Utenti')

@section('acontent')
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default" data-toggle="modal" data-target="#new-user">Crea Nuovo Utente</button>
		</div>
	</div>

	<div class="modal fade" id="new-user" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Crea Nuovo Utente</h4>
				</div>

				{!! BootForm::horizontal(['action' => 'UserController@store']) !!}
					<div class="modal-body">
						{!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
						{!! BootForm::text('surname', 'Cognome', '', ['required' => 'required']) !!}
						{!! BootForm::text('phone', 'Telefono', '', ['required' => 'required']) !!}
						{!! BootForm::email('email', 'E-Mail', '', ['required' => 'required']) !!}
						{!! BootForm::textarea('notes', 'Note') !!}
                        {!! BootForm::radios('role', 'Ruolo', ['admin' => 'Amministratore', 'operator' => 'Operatore', 'user' => 'Donatore'], 'user') !!}
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
						<th>Nome</th>
						<th>Cognome</th>
                        <th>Ruolo</th>
						<th>Telefono</th>
						<th>E-Mail</th>
                        <th>Azioni</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>
                                <?php

                                switch($user->role) {
                                    case 'admin':
                                        echo 'Amministratore';
                                        break;

                                    case 'operator':
                                        echo 'Operatore';
                                        break;

                                    case 'user':
                                        echo 'Donatore';
                                        break;
                                }

                                ?>
                            </td>
							<td>{{ $user->phone }}</td>
							<td>{{ $user->email }}</td>
                            <td><button class="btn btn-default show-details" data-endpoint="utente" data-item-id="{{ $user->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{ $users->links() }}
		</div>
	</div>
@endsection
