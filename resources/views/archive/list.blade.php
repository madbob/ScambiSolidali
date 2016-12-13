@extends('layouts.admin')

@section('title', 'Archivio Donazioni')

@section('acontent')

@if($mine->isEmpty() == false)
    <div class="row">
        <div class="col-md-12">
            @foreach($mine as $donation)
                <div class="row well">
                    <div class="col-md-4">
                        <form class="form-horizontal">
                            @include('donation.info', ['donation' => $donation])
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php $availabilities = json_decode($donation->availability) ?>
                        @if(empty($availabilities))
                            <div class="alert alert-warning">
                                <p>Non sono ancora state fornite disponibilità</p>
                            </div>
                        @else
                            <p>Disponibilità per il ritiro:</p>
                            <ul>
                                @foreach($availabilities as $a)
                                    <li>{{ sprintf('%d/%d alle %s', $a->day, $a->month, join(' o alle ', $a->hours)) }}</li>
                                @endforeach
                            </ul>
                            <p>
                                Si raccomanda di contattare il donatore per fissare un appuntamento.
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4 text-right">
                        <form method="POST" action="{{ url('archivio/' . $donation->id) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="status" value="pending">
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-danger">Annulla l'assegnazione</button>
                        </form>

                        <br>

                        <form method="POST" action="{{ url('archivio/' . $donation->id) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="status" value="voided">
                            <input type="hidden" name="_method" value="PUT">
                            <button class="btn btn-warning">Annulla la donazione</button>
                        </form>

                        <br>

                        <form method="POST" action="{{ url('archivio/' . $donation->id) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="status" value="shipped">
                            <input type="hidden" name="_method" value="PUT">
                            <button class="btn btn-success">Marca come consegnato</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        @if($donations->isEmpty())
            <div class="alert alert-info">
                <p>
                    Non ci sono donazioni in archivio.
                </p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Oggetto</th>
                        <th>Utente</th>
                        <th>Stato</th>
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
                            <td>{{ $donation->printableStatus() }}</td>
                            <td>
                                <button class="btn btn-default show-details" data-endpoint="donazione" data-item-id="{{ $donation->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </td>
                        </tr>
    				@endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
