@extends('layouts.app')

@section('title', 'Archivio')

@section('content')
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('donation.report') }}">Scarica Report Donazioni</a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col">
            <x-larastrap::form formview="inline" method="GET" route="celo.archive" :buttons="[['label' => 'Cerca']]">
                <x-larastrap::text name="search" placeholder="Cerca" :value="$search" />
                <x-larastrap::radios name="status" squeeze :options="App\Donation::statuses()" />
            </x-larastrap::form>
        </div>
    </div>

    <hr>

    <div class="celo primary-1">
    	<div class="row">
            <div class="col">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
                    <table class="table">
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
                                    <td>{{ printableDate($donation->created_at) }}</td>
                                    <td>{{ printableDate($donation->assignation_date) }}</td>
                                    <td>{{ $donation->printableStatus() }}</td>
                                    <td>
                                        <button class="btn btn-default show-details" data-endpoint="celo" data-item-id="{{ $donation->id }}">
                                            <i class="bi bi-search"></i>
                                        </button>

                                        @if($donation->status == 'pending')
                                            <a class="btn btn-default" href="{{ route('donation.my', $donation->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif
                                    </td>
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
