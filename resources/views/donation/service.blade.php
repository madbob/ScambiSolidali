@extends('layouts.app')

@section('title', 'Celo')

@section('content')

<?php

if (isset($call) == false) {
    $call = null;
}

if (isset($donation) == false) {
    $donation = null;
}
else {
    $call = $donation->call;
}

?>

@if($donation)
    @include('donation.partials.delete', ['donation' => $donation])
    <br/>
@endif

<x-larastrap::form classes="primary-1" :obj="$donation" baseaction="celo" :buttons="['element' => 'sbtn', 'label' => 'Allora clicca qui!', 'attributes' => ['type' => 'submit']]">
    <div class="alert alert-danger">
        Attenzione! Se intendi donare un oggetto, non compilare questo form ma <a href="{{ route('celo.create') }}">clicca qui</a>! Le donazioni di oggetti compilate tramite questo form saranno rimosse dagli amministratori.
    </div>

    <div class="row">
        <div class="col">
            @include('call.selector', [
                'call' => $call,
                'donation' => $donation,
                'call_type' => 'service',
                'direct_response' => false
            ])

            <input type="hidden" name="type" value="service">

            @include('category.selector', [
                'orientation' => 'horizontal',
                'selected' => $donation ? $donation->category_id : null,
                'type' => 'service',
                'direct_response' => false
            ])

            <x-larastrap::text name="title" label="Cosa offro" required />
            <x-larastrap::textarea name="description" label="Descrizione" required />
            <x-larastrap::date name="since" label="Disponibile da" :value="date('Y-m-d')" />

            <br><br><br>

            <?php $last = $donation ? $donation : $currentuser->lastDonation() ?>

            <x-larastrap::enclose :obj="$last">
                <x-larastrap::text name="name" label="Nome" required />
                <x-larastrap::text name="surname" label="Cognome" required />

                @if(App\Config::getConf('explicit_zones') == 'true')
                    <x-larastrap::field label="Zona">
                        @include('donation.areaselect', [
                            'selected' => $donation ? $donation->area : null,
                            'field_name' => 'area',
                        ])
                    </x-larastrap::field>
                @endif

                <x-larastrap::text name="address" label="Indirizzo" />
                <x-larastrap::text name="phone" label="Telefono" required />
                <x-larastrap::email name="email" label="E-Mail" required />
            </x-larastrap::enclose>
        </div>
    </div>

    <p class="text-center mt-5">
        (HAI SCRITTO TUTTO TUTTO?)
    </p>
</x-larastrap::form>

@if($donation)
    @include('donation.partials.delete', ['donation' => $donation])
@endif

@endsection
