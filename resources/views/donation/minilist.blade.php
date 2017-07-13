<?php $role = Auth::user()->role ?>

@if($list->isEmpty())
    <div class="alert alert-info">
        <p>Elenco vuoto</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>

                <th>Operatore</th>

                @if($print_object == true)
                    <th>Oggetto</th>
                @endif

                <th>Stato</th>

                @if($role == 'admin')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->pivot->updated_at))) }}</td>

                    <td>{{ App\User::find($item->pivot->operator_id)->printableOperatorName() }}</td>

                    @if($print_object == true)
                        <td>{{ App\Donation::find($item->pivot->donation_id)->title }}</td>
                    @endif

                    <td>
                        @if($item->pivot->status == 'booked')
                            Prenotato
                        @elseif($item->pivot->status == 'assigned')
                            Assegnato
                        @elseif($item->pivot->status == 'shipping_needed')
                            Trasporto
                        @elseif($item->pivot->status == 'shipped')
                            Consegnato
                        @elseif($item->pivot->status == 'voided')
                            Annullato
                        @endif
                    </td>

                    @if($role == 'admin')
                        <td>
                            <button class="btn btn-default async-delete-interaction assignation" data-donation-id="{{ $donation->id }}" data-item-id="{{ $item->id }}">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
