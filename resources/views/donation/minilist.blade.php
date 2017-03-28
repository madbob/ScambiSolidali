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

                @if($print_receiver == true)
                    <th>Ricevente</th>
                @endif

                @if($print_object == true)
                    <th>Oggetto</th>
                @endif

                <th>Stato</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->pivot->updated_at))) }}</td>

                    <td>{{ App\User::find($item->pivot->operator_id)->printableName() }}</td>

                    @if($print_receiver == true)
                        <td>{{ App\Receiver::find($item->pivot->receiver_id)->printableName() }}</td>
                    @endif

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
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
