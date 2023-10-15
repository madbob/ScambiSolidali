@extends('layouts.app', [
    'custom_js' => [
        "//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js",
        "//cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js",
    ],
    'custom_css' => [
        "//cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css",
    ],
])

@section('title', 'Archivio')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default" href="{{ url('donazione/report') }}">Scarica Report Donazioni</a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" method="GET" action="{{ url('celo/archivio') }}">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Cerca" value="{{ $search }}">
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="status" value="" {{ $status == '' ? 'checked' : '' }}> <small>Nessuno</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="pending" {{ $status == 'pending' ? 'checked' : '' }}> <small>In attesa</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="voided" {{ $status == 'voided' ? 'checked' : '' }}> <small>Annullato</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="assigned" {{ $status == 'assigned' ? 'checked' : '' }}> <small>Assegnato</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="expiring" {{ $status == 'expiring' ? 'checked' : '' }}> <small>In Scadenza</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="expired" {{ $status == 'expired' ? 'checked' : '' }}> <small>Scaduto</small>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="dropped" {{ $status == 'dropped' ? 'checked' : '' }}> <small>Abbandonato</small>
                    </label>
                </div>
                <button type="submit" class="btn btn-default pull-right">Cerca</button>
            </form>
        </div>
    </div>

    <br>

    <div class="celo primary-1">
    	<div class="row">
            <div class="col-md-12">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th width="30%">Titolo</th>
                                <th width="15%">Utente</th>
                                <th width="15%">Data Creazione</th>
                                <th width="15%">Data Assegnazione</th>
                                <th width="15%">Stato</th>
                                <th width="10%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
            				@foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->title }}</td>
                                    <td>{{ $donation->user->printableName() }}</td>
                                    <td data-sort="{{ $donation->created_at }}">{{ printableDate($donation->created_at) }}</td>
                                    <td data-sort="{{ $donation->assignation_date }}">{{ printableDate($donation->assignation_date) }}</td>
                                    <td>{{ $donation->printableStatus() }}</td>
                                    <td>
                                        <button class="btn btn-default show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                        @if($donation->status == 'pending')
                                            <a class="btn btn-default" href="{{ url('donazione/mio/' . $donation->id) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        @endif
                                    </td>
                                </tr>
            				@endforeach
                        </tbody>
                    </table>
                @endif
    		</div>
    	</div>
    </div>
@endsection
