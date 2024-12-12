@php
$user = $donation->user;
$others = $user->donations()->where('status', 'pending')->where('donations.id', '!=', $donation->id)->get();
@endphp

@if($others->isEmpty() == false)
    <hr/>
    <h4>Annunci dello stesso utente</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Oggetto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($others as $item)
                <tr>
                    <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->updated_at))) }}</td>
                    <td>{{ $item->title }}</td>
                    <td class="text-end">
                        <button class="btn btn-default show-details" data-endpoint="celo" data-item-id="{{ $item->id }}">
                            <i class="bi bi-search"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
