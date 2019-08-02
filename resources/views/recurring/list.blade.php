@extends('layouts.app')

@section('title', 'Donazioni Periodiche')

@section('content')
    <div class="celo primary-1">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ route('periodico.archivio') }}">Archivio</a>

                <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#reset_weekly">Resetta Donazioni</button>
                <div class="modal fade primary-1" id="reset_weekly" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Resetta Donazioni Settimanali</h4>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('periodico.reset_weekly') }}">
                                            {{ csrf_field() }}

                                            <p>
                                                Procedendo le attuali donazioni settiminali saranno archiviate, saranno generati nuovi slot e saranno inviati gli SMS di notifica agli esercenti. Vuoi continuare?
                                            </p>

                                            <hr>

                                            <div class="form-group">
                                                <div>
                                                    <button class="button" type="submit">
                                                        <span>Si, Resetta</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    	<div class="row">
            <div class="col-md-12">
                @if($weekly->isEmpty())
                    <div class="page-header">
                        <h3>
                            Donazioni Settimanali
                        </h3>
                    </div>

                    <div class="alert alert-info">
                        <p>
                            Non ci sono donazioni settimanali ricorrenti attive.
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
                                <th width="25%">Azienda</th>
                                <th width="5%">Stato</th>
                                <th width="10%">Box Disponibili</th>
                                <th width="15%">Commento</th>
                                <th width="15%">Note</th>
                                <th width="30%">Contatti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $boxes = 0 ?>

            				@foreach($weekly as $donation)
                                <tr>
                                    <td>
                                        {{ $donation->company->name }}<br>
                                        {{ $donation->company->address_street }}<br>
                                        Apertura: {{ $donation->company->opening_hours }}<br>
                                        Ritiro: {{ $donation->company->preferred_hours }}
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
                                        @if ($donation->status == 'ok')
                                            {!! nl2br($donation->data->comment) !!}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($donation->status == 'ok')
                                            {!! nl2br($donation->data->notes) !!}
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            @if(!empty($donation->company->phone))
                                                <li>{{ $donation->company->phone }}</li>
                                            @endif

                                            @foreach($donation->company->users as $u)
                                                @if(!empty($u->phone))
                                                    <li>{{ $u->printableName() }} - {{ $u->phone }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
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
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                @endif
    		</div>
    	</div>
    </div>

    <div class="celo primary-1">
    	<div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h3>
                        Donazioni Mensili
                    </h3>
                </div>

                @if($monthly->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono donazioni mensili ricorrenti attive.
                        </p>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="25%">Azienda</th>
                                <th width="5%">Stato</th>
                                <th width="20%">Prodotti Disponibili</th>
                                <th width="20%">Note</th>
                                <th width="30%">Contatti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $collective_month = [];
                            foreach(App\Recurring::categories() as $cat) {
                                $collective_month[$cat->identifier] = 0;
                            }

                            $labels = App\Recurring::categoriesLabels();

                            ?>

                            @foreach($monthly as $donation)
                                <tr>
                                    <td>
                                        {{ $donation->company->name }}<br>
                                        {{ $donation->company->address_street }}<br>
                                        Apertura: {{ $donation->company->opening_hours }}<br>
                                        Ritiro: {{ $donation->company->preferred_hours }}
                                    </td>

                                    <td><span class="glyphicon glyphicon-{{ $donation->status_icon }}" aria-hidden="true"></span></td>

                                    <td>
                                        @if ($donation->status == 'ok')
                                            @foreach($donation->data->quantities as $q)
                                                <?php $collective_month[$q->type] += $q->quantity ?>
                                                <li>{{ $labels[$q->type] }}: {{ App\Recurring::printableCategoryQuantity($q->type, $q->quantity) }}</li>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @if ($donation->status == 'ok')
                                            {!! nl2br($donation->data->notes) !!}
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            @if(!empty($donation->company->phone))
                                                <li>{{ $donation->company->phone }}</li>
                                            @endif

                                            @foreach($donation->company->users as $u)
                                                @if(!empty($u->phone))
                                                    <li>{{ $u->printableName() }} - {{ $u->phone }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                @foreach($collective_month as $product => $quantity)
                                    <th>{{ $labels[$product] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Totale Disponibile</td>
                                @foreach($collective_month as $product => $quantity)
                                    <td>{{ App\Recurring::printableCategoryQuantity($product, $quantity) }}</td>
                                @endforeach
                            </tr>
                            @foreach(App\RecurringPick::where('closed', false)->get() as $pick)
                                <tr>
                                    <td>{{ $pick->institute->name }}</td>
                                    @foreach($collective_month as $product => $quantity)
                                        <td>{{ App\Recurring::printableCategoryQuantity($product, $pick->getQuantity($product)) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
    		</div>
    	</div>
    </div>
@endsection
