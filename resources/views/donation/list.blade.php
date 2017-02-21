@extends('layouts.admin')

@section('title', 'Ricerca Donazioni')

@section('acontent')

@if($current_show != -1)
    <input type="hidden" name="trigger-show-details" data-endpoint="donazione" data-item-id="{{ $current_show }}">
@endif

<div class="row">
    <div class="col-md-12">
        @if($donations->isEmpty())
            <div class="alert alert-info">
                <p>
                    Non ci sono donazioni in attesa.
                </p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Oggetto</th>
                        <th>Utente</th>
                        <th>Recuperabile</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($donations as $donation)
                        <tr data-donation-id="{{ $donation->id }}">
                            <td class="category">{{ $donation->category->name }}</td>
                            <td>{{ $donation->title }}</td>
                            <td>
								{{ $donation->user->printableName() }}
								@include('user.rating', ['user' => $donation->user])
                            </td>
                            <td>
                                @if($donation->recoverable)
                                    @if($donation->really_recoverable)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    @else
                                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                                    @endif
                                @else
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-default show-details" data-endpoint="donazione" data-item-id="{{ $donation->id }}">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
					@endforeach
                </tbody>
            </table>

            <div class="text-center">
                {{ $donations->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
