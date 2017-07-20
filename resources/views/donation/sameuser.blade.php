<?php

$user = $donation->user;
$others = $user->donations()->where('status', 'pending')->where('donations.id', '!=', $donation->id)->get();

?>

@if($others->isEmpty() == false)
    <hr/>
    <h4>Donazioni dello stesso utente</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Oggetto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($others as $item)
                <tr>
                    <td>{{ ucwords(strftime('%d/%m/%G', strtotime($item->updated_at))) }}</td>
                    <td>{{ $item->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
