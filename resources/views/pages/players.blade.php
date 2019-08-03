@extends('layouts.app')

@section('title', 'Giocatori')

@section('content')
    <input type="hidden" name="trigger-show-details" data-endpoint="giocatori" data-item-id="{{ $current_show }}">

    <div class="players primary-1">
        @if($currentuser && $currentuser->role == 'admin')
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="{{ $current_tab == 'entities' ? 'active' : '' }}">
                            <span>
                                <a href="#entities" aria-controls="entities" role="tab" data-toggle="tab">Associazioni</a>
                            </span>
                        </li>

                        @if(env('HAS_FOOD', false))
                            <li role="presentation" class="{{ $current_tab == 'companies' ? 'active' : '' }}">
                                <span>
                                    <a href="#companies" aria-controls="companies" role="tab" data-toggle="tab">Aziende</a>
                                </span>
                            </li>
                        @endif

                        <li role="presentation" class="{{ $current_tab == 'users' ? 'active' : '' }}">
                            <span>
                                <a href="#users" aria-controls="users" role="tab" data-toggle="tab">Utenti</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane {{ $current_tab == 'entities' ? 'active' : '' }}" id="entities">
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

                            var coords = [{{ App\Config::getConf('players_map_coordinates') }}];
                            var zoom = {{ App\Config::getConf('players_map_zoom') }};
                        </script>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        @foreach($institutes as $institute)
                            <div class="col-md-12 spaced-middle border-bottom">
                                @if($currentuser && $currentuser->role == 'admin')
                                    <div class="pull-right">
                                        <p class="show-details" data-endpoint="ente" data-item-id="{{ $institute->id }}">Edit</p>
                                    </div>
                                @endif
                                <p class="institute" data-institute-id="{{ $institute->id }}">
                                    @if(!empty($institute->website))
                                        <a href="{{ $institute->website }}">{{ $institute->name }}</a>
                                    @else
                                        {{ $institute->name }}
                                    @endif
                                </p>
                            </div>
                        @endforeach

                        <br/>

                        @if($currentuser && $currentuser->role == 'admin')
                            <div class="col-md-12">
                                <button class="btn btn-default button" data-toggle="modal" data-target="#institute-new">
                                    <span>Aggiungi Associazione</span>
                                </button>
                                @include('institute.modal', ['institute' => null])
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($currentuser && $currentuser->role == 'admin')
                @if(env('HAS_FOOD', false))
                    <div role="tabpanel" class="tab-pane  {{ $current_tab == 'companies' ? 'active' : '' }}" id="companies">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default button" data-toggle="modal" data-target="#company-new">
                                    <span>Crea Nuova Azienda</span>
                                </button>
                                @include('company.modal', ['company' => null])
                            </div>
                        </div>

                        <table class="table users-list">
            				<thead>
            					<tr>
            						<th>Nome</th>
                                    <th>Utenti</th>
                                    <th>Azioni</th>
            					</tr>
            				</thead>
            				<tbody>
            					@foreach($companies as $c)
                                    <tr>
            							<td>{{ $c->name }}</td>
                                        <td>
                                            {{ join(', ', $c->users->reduce(function($carry, $item) {
                                                $carry[] = $item->printableName();
                                                return $carry;
                                            }, [])) }}
                                        </td>
                                        <td><button class="btn btn-default show-details" data-endpoint="azienda" data-item-id="{{ $c->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
            						</tr>
            					@endforeach
            				</tbody>
            			</table>
                    </div>
                @endif

                <div role="tabpanel" class="tab-pane  {{ $current_tab == 'users' ? 'active' : '' }}" id="users">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-default button" data-toggle="modal" data-target="#user-new">
                                <span>Crea Nuovo Utente</span>
                            </button>
                            @include('user.modal', ['user' => null])
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-default button" data-toggle="modal" data-target="#massive-mail">
                                <span>Invia Mail</span>
                            </button>
                            <div class="modal fade primary-1" id="massive-mail" tabindex="-1" role="dialog">
                                <div class="modal-dialog mnodal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Invia Mail</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! BootForm::vertical(['model' => null, 'store' => 'giocatori.mail']) !!}
                                                        <?php

                                                        $selector = [];
                                                        foreach(App\User::existingRoles() as $identifier => $metadata) {
                                                            $selector[$identifier] = sprintf('Tutti ' . $metadata->multiple);
                                                        }

                                                        ?>

                                                        {!! BootForm::radios('recipients', 'Destinatari', $selector) !!}

                                                        {!! BootForm::text('subject', 'Oggetto') !!}
                                                        {!! BootForm::textarea('body', 'Testo') !!}

                                                        <div class="form-group">
                                                            <div>
                                                                <button class="button" type="submit">
                                                                    <span>Salva</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    {!! BootForm::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <a class="btn btn-default" href="{{ route('giocatori.export') }}">Esporta CSV</a>
                            <div class="btn-group pull-right" role="group" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="radio" name="role-filter" data-role="all" autocomplete="off" checked> Tutti
                                </label>
                                @foreach($counters as $identifier => $label)
                                    <label class="btn btn-default">
                                        <input type="radio" name="role-filter" data-role="{{ $identifier }}" autocomplete="off"> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <table class="table users-list">
        				<thead>
        					<tr>
                                <th width="15%">Ruolo</th>
        						<th width="20%">Nome</th>
        						<th width="20%">Cognome</th>
        						<th width="20%">Telefono</th>
        						<th width="20%">E-Mail</th>
                                <th width="5%">Azioni</th>
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
