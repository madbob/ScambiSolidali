@extends('layouts.players')

@section('title', 'Aziende')

@section('contents')

<div class="row">
    <div class="col">
        <button class="btn btn-default button" data-bs-toggle="modal" data-bs-target="#company-new">
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

@endsection
