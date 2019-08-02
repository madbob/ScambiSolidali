@extends('layouts.app')

@section('title', 'Donazioni Periodiche')

@section('content')
    <div class="celo primary-1">
    	<div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('periodico.index') }}" class="list-group-item">Donazioni Attive</a>
                    @foreach($dates as $d)
                        <a href="{{ route('periodico.archivio', ['date' => canonicalDate($d->created_at)]) }}" class="list-group-item">{{ printableDate($d->created_at) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                @if($weekly->isEmpty())
                    <div class="page-header">
                        <h3>
                            Donazioni Settimanali
                        </h3>
                    </div>

                    <div class="alert alert-info">
                        <p>
                            Non ci sono donazioni settimanali ricorrenti per questa data.
                        </p>
                    </div>
                @else
                    <div class="page-header">
                        <h3>
                            Donazioni Settimanali ({{ printableDate($weekly->first()->created_at) }})
                        </h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="35%">Azienda</th>
                                <th width="5%">Stato</th>
                                <th width="10%">Box Disponibili</th>
                                <th width="25%">Commento</th>
                                <th width="25%">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $boxes = 0 ?>

            				@foreach($weekly as $donation)
                                <tr>
                                    <td>
                                        {{ $donation->company->name }}
                                    </td>

                                    <td><span class="glyphicon glyphicon-{{ $donation->status_icon }}" aria-hidden="true"></span></td>

                                    <td>
                                        <?php

                                        if ($donation->status == 'ok') {
                                            $boxes += $donation->data->quantity;
                                            echo sprintf('%d box', $donation->data->quantity);
                                        }

                                        ?>
                                    </td>

                                    <td>
                                        @if ($donation->status == 'ok' && isset($donation->data->comment))
                                            {!! nl2br($donation->data->comment) !!}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($donation->status == 'ok')
                                            {!! nl2br($donation->data->notes) !!}
                                        @endif
                                    </td>
                                </tr>
            				@endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Totale</th>
                                <th>&nbsp;</th>
                                <th>{{ $boxes }} box</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                @endif
    		</div>
    	</div>
    </div>
@endsection
