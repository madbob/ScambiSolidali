@extends('layouts.app')

@section('title', 'Le Mie Donazioni')

@section('content')

@if($current_show != -1)
    <input type="hidden" name="trigger-show-details" data-endpoint="donazione" data-item-id="{{ $current_show }}">
@endif

<div class="row">
    <div class="col-md-12">
        @if($donations->isEmpty())
            <div class="alert alert-info">
                <p>
                    Non hai ancora effettuato donazioni.
                </p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Oggetto</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($donations as $donation)
                        <tr data-donation-id="{{ $donation->id }}">
                            <td class="category">{{ $donation->category->name }}</td>
                            <td>{{ $donation->title }}</td>
                            <td>
                                @if($donation->status == 'pending')
                                    <button class="btn btn-default show-details" data-endpoint="donazione/{id}/edit" data-item-id="{{ $donation->id }}">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                @endif
                            </td>
                        </tr>
					@endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
