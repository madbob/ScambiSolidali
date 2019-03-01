@extends('layouts.app')

@section('title', 'Archivio')

@section('content')
    <div class="celo primary-1">
    	<div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h3>Donazioni Settimanali</h3>
                </div>

                @if($weekly->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono donazioni settimanali ricorrenti attive.
                        </p>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="30%">Azienda</th>
                                <th width="10%">Stato</th>
                                <th width="20%">Box Disponibili</th>
                                <th width="40%">Contatti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $boxes = 0 ?>

            				@foreach($weekly as $donation)
                                <tr>
                                    <td>{{ $donation->company->name }}</td>
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
                    <h3>Donazioni Mensili</h3>
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
                                <th width="30%">Azienda</th>
                                <th width="10%">Stato</th>
                                <th width="20%">Prodotti Disponibili</th>
                                <th width="40%">Contatti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $collective_month = [];
                            foreach(App\Recurring::categories() as $cat)
                                $collective_month[$cat->label] = 0;

                            ?>

                            @foreach($weekly as $donation)
                                <tr>
                                    <td>{{ $donation->company->name }}</td>
                                    <td><span class="glyphicon glyphicon-{{ $donation->status_icon }}" aria-hidden="true"></span></td>

                                    <td>
                                        @if ($donation->status == 'ok')
                                            @foreach($donation->data->quantities as $q)
                                                <?php $collective_month[$q->type] += $q->quantity ?>
                                                <li>{{ $q->type }}: {{ App\Recurring::printableCategoryQuantity($q->type, $q->quantity) }}</li>
                                            @endforeach
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
                                <th>
                                    <ul>
                                        @foreach($collective_month as $product => $quantity)
                                            <li>{{ $product }}: {{ App\Recurring::printableCategoryQuantity($product, $quantity) }}</li>
                                        @endforeach
                                    </ul>
                                </th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                @endif
    		</div>
    	</div>
    </div>
@endsection