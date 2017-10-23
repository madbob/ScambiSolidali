@extends('layouts.app')

@section('title', 'Archivio')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default" href="{{ url('donazione/report') }}">Scarica Report Donazioni</a>
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
