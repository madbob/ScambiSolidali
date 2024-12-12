@extends('layouts.players')

@section('title', 'Utenti')

@section('contents')

<div class="row">
    <div class="col">
        <button class="btn btn-default button" data-bs-toggle="modal" data-bs-target="#user-new">
            <span>Crea Nuovo Utente</span>
        </button>

        @include('user.modal', ['user' => null])
    </div>
    <div class="col">
        <button class="btn btn-default button" data-bs-toggle="modal" data-bs-target="#massive-mail">
            <span>Invia Mail</span>
        </button>

        <x-larastrap::modal id="massive-mail">
            <div class="row">
                <div class="col">
                    <x-larastrap::form route="giocatori.mail">
                        <?php

                        $selector = [];
                        foreach(App\User::existingRoles() as $identifier => $metadata) {
                            $selector[$identifier] = sprintf('Tutti ' . $metadata->multiple);
                        }

                        ?>

                        <x-larastrap::radiolist name="recipients" label="Destinatari" :options="$selector" />

                        @if(App\Config::getConf('explicit_zones') == 'true')
                            <x-larastrap::checklist name="area" label="Area" :options="App\Donation::areas()" />
                        @endif

                        <x-larastrap::text name="subject" label="Oggetto" required />
                        <x-larastrap::textarea name="body" label="Testo" required />
                    </x-larastrap::form>
                </div>
            </div>
        </x-larastrap::modal>
    </div>
    <div class="col">
        <a class="btn btn-default button" href="{{ route('giocatori.export') }}">
            <span>Esporta CSV</span>
        </a>
    </div>
</div>

<div class="row my-3 justify-content-end">
    <div class="col">
        <div class="btn-group" role="group" data-bs-toggle="buttons">
            <a class="btn btn-default {{ $filter == 'all' ? 'active' : '' }}" href="{{ route('utenti.index') }}">Tutti</a>

            @foreach($counters as $identifier => $label)
                <a class="btn btn-default {{ $filter == $identifier ? 'active' : '' }}" href="{{ route('utenti.index', ['filter' => $identifier]) }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table users-list small">
                <thead>
                    <tr>
                        <th width="5%">Ruolo</th>
                        <th width="20%">Nome</th>
                        <th width="20%">Cognome</th>
                        <th width="20%">Telefono</th>
                        <th width="20%">E-Mail</th>
                        <th width="10%">Ente</th>
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
                            <td>{{ $u->printableOrganizations() }}</td>
                            <td>
                                <button class="btn btn-default show-details" data-endpoint="utenti" data-item-id="{{ $u->id }}">
                                    <i class="bi bi-search"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! $users->links() !!}
    </div>
</div>

@endsection
