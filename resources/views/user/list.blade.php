@extends('layouts.admin')

@section('title', 'Utenti')

@section('acontent')
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default" data-toggle="modal" data-target="#new-user">Crea Nuovo Utente</button>
            <button class="btn btn-default" data-toggle="modal" data-target="#new-institute">Crea Nuovo Ente</button>
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
                        {!! BootForm::radios('role', 'Ruolo', [
                            'admin' => 'Amministratore',
                            'operator' => 'Operatore',
                            'carrier' => 'Trasporto',
                            'user' => 'Utente'
                        ], 'user') !!}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
						<button type="submit" class="btn btn-primary">Salva</button>
					</div>
				{!! BootForm::close() !!}
			</div>
		</div>
	</div>

    <div class="modal fade" id="new-institute" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Crea Nuovo Ente</h4>
				</div>

				{!! BootForm::horizontal(['action' => 'InstituteController@store']) !!}
					<div class="modal-body">
						{!! BootForm::text('name', 'Nome', '', ['required' => 'required']) !!}
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
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#institutes" aria-controls="institutes" role="tab" data-toggle="tab">Enti</a></li>
                <li role="presentation"><a href="#operators" aria-controls="operators" role="tab" data-toggle="tab">Operatori</a></li>
                <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Utenti</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="institutes">
        			<table class="table">
        				<thead>
        					<tr>
        						<th>Nome</th>
                                <th>Operatori</th>
                                <th>Azioni</th>
        					</tr>
        				</thead>
        				<tbody>
        					@foreach($institutes as $institute)
        						<tr>
        							<td>{{ $institute->name }}</td>
                                    <td>{{ $institute->users()->count() }}</td>
                                    <td><button class="btn btn-default show-details" data-endpoint="ente" data-item-id="{{ $institute->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
        						</tr>
        					@endforeach
        				</tbody>
        			</table>
                </div>
                <div role="tabpanel" class="tab-pane" id="operators">
        			<table class="table">
        				<thead>
        					<tr>
        						<th>Nome</th>
        						<th>Cognome</th>
        						<th>Telefono</th>
        						<th>E-Mail</th>
                                <th>Enti</th>
                                <th>Azioni</th>
        					</tr>
        				</thead>
        				<tbody>
        					@foreach($operators as $operator)
        						<tr>
        							<td>{{ $operator->name }}</td>
                                    <td>{{ $operator->surname }}</td>
        							<td>{{ $operator->phone }}</td>
        							<td>{{ $operator->email }}</td>
                                    <td>
                                        <?php
                                            $insts = [];
                                            foreach($operator->institutes as $inst)
                                                $insts[] = $inst->name;

                                            echo join(', ', $insts);
                                        ?>
                                    </td>
                                    <td><button class="btn btn-default show-details" data-endpoint="utente" data-item-id="{{ $operator->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
        						</tr>
        					@endforeach
        				</tbody>
        			</table>
                </div>
                <div role="tabpanel" class="tab-pane" id="users">
        			<table class="table">
        				<thead>
        					<tr>
        						<th>Nome</th>
        						<th>Cognome</th>
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
        							<td>{{ $user->phone }}</td>
        							<td>{{ $user->email }}</td>
                                    <td><button class="btn btn-default show-details" data-endpoint="utente" data-item-id="{{ $user->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
        						</tr>
        					@endforeach
        				</tbody>
        			</table>
                </div>
            </div>
		</div>
	</div>
@endsection
