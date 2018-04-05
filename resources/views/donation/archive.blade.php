@extends('layouts.app')

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
                    <table class="table">
                        <tbody>
            				@foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->title }}</td>
                                    <td>{{ printableDate($donation->created_at) }}</td>
                                    <td>{{ $donation->printableStatus() }}</td>
                                    <td><button class="btn btn-default show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td>
                                </tr>
            				@endforeach
                        </tbody>
                    </table>

        			{{ $donations->links() }}
                @endif
    		</div>
    	</div>
    </div>
@endsection
