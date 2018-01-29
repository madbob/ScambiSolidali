@extends('layouts.app')

@section('title', 'Giocatori')

@section('content')
    <div class="players primary-1">
        @if($user && $user->role != 'user')
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <span>
                                <a href="#entities" aria-controls="entities" role="tab" data-toggle="tab">Associazioni</a>
                            </span>
                        </li>

                        @if($user->role == 'admin')
                            <li role="presentation">
                                <span>
                                    <a href="#users" aria-controls="users" role="tab" data-toggle="tab">Utenti</a>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="entities">
                <div class="row">
                    <div class="col-md-6">
                        <div class="map" id="mapid"></div>
                        <script>
                            var geoJson = {
                                id: "points",
                                type: "symbol",
                                source: {
                                    type: "geojson",
                                    data: {
                                        type: "FeatureCollection",
                                        features: [
                                            @foreach($institutes as $institute)
                                                {
                                                    type: 'Feature',
                                                    geometry: {
                                                        type: "Point",
                                                        coordinates: [{{ $institute->lng }}, {{ $institute->lat }}]
                                                    },
                                                    properties: {
                                                        title: "",
                                                        id: {{ $institute->id }}
                                                    }
                                                },
                                            @endforeach
                                        ]
                                    }
                                },
                                layout: {
                                    "icon-image": "star-15",
                                    "icon-allow-overlap": true,
                                    "text-field": "{title}",
                                    "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
                                    "text-offset": [0, 0.6],
                                    "text-anchor": "top"
                                }
                            };
                        </script>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        @foreach($institutes as $institute)
                            <div class="row border-bottom">
                                <div class="col-md-12 spaced-middle">
                                    @if($user && $user->role == 'admin')
                                        <div class="pull-right">
                                            <p class="show-details" data-endpoint="ente" data-item-id="{{ $institute->id }}">Edit</p>
                                        </div>
                                    @endif
                                    <p class="institute" data-institute-id="{{ $institute->id }}">
                                        @if(!empty($institute->website))
                                            <a href="{{ $institute->website }}">
                                        @endif
                                        {{ $institute->name }}
                                        @if(!empty($institute->website))
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <br/>

                        @if($user && $user->role == 'admin')
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-default button" data-toggle="modal" data-target="#institute-new">
                                        <span>Aggiungi Ente</span>
                                    </button>
                                    @include('institute.modal', ['institute' => null])
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($user && $user->role == 'admin')
                <div role="tabpanel" class="tab-pane" id="users">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-default button" data-toggle="modal" data-target="#user-new">
                                <span>Crea Nuovo Utente</span>
                            </button>
                            @include('user.modal', ['user' => null])
                        </div>

                        <div class="col-md-6">
                            <div class="btn-group pull-right" role="group" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="radio" name="role-filter" data-role="all" autocomplete="off" checked> Tutti
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="role-filter" data-role="admin" autocomplete="off"> {{ $admins_count }} Amministratori
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="role-filter" data-role="user" autocomplete="off"> {{ $users_count }} Utenti
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="role-filter" data-role="operator" autocomplete="off"> {{ $operators_count }} Operatori
                                </label>
                            </div>
                        </div>
                    </div>

                    <table class="table users-list">
        				<thead>
        					<tr>
                                <th>Ruolo</th>
        						<th>Nome</th>
        						<th>Cognome</th>
        						<th>Telefono</th>
        						<th>E-Mail</th>
                                <th>Azioni</th>
        					</tr>
        				</thead>
        				<tbody>
        					@foreach($users as $u)
                                <tr data-role="{{ $u->role }}">
                                    <td>{{ $u->role_name }}</td>
        							<td>{{ $u->name }}</td>
                                    <td>{{ $u->surname }}</td>
        							<td>{{ $u->phone }}</td>
        							<td>{{ $u->email }}</td>
                                    <td><button class="btn btn-default show-details" data-endpoint="giocatori" data-item-id="{{ $u->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
        						</tr>
        					@endforeach
        				</tbody>
        			</table>
                </div>
            @endif
        </div>
    </div>
@endsection
