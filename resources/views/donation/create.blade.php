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
    <div class="row">
        <div class="col-12 col-md-3">
            @if($donation)
                @for($i = 1; $i <= $donation->imagesNum(); $i++)
                    <div class="common-card">
                        <div class="card-main vert-align image-frame bg-white txt-color" style="background-image: url('{{ $donation->imageUrl($i) }}')">
                        </div>
                        <div class="card-footer vert-align">
                            <p class="removefile">
                                RIMUOVI FOTO
                            </p>
                        </div>

                        <input type="hidden" name="keep_photo[]" value="{{ $i }}">
                    </div>
                    <br/>
                @endfor
            @endif

            <div class="common-card fileuploader">
                <div class="card-main vert-align image-frame bg-white txt-color">
                    <p>
                        <canvas id="preview-canvas" height="0" width="0"></canvas>
                    </p>
                </div>
                <div class="card-footer vert-align">
                    <p>
                        CARICA FOTO
                    </p>
                </div>

                <x-larastrap::file name="photo[]" hidden />
            </div>
        </div>

        <div class="col-12 col-md-8 offset-md-1">
            @include('call.selector', [
                'call' => $call,
                'donation' => $donation,
                'call_type' => 'object',
                'direct_response' => false
            ])

            <x-larastrap::hidden name="type" value="object" />

            <x-larastrap::text name="title" label="Il mio Oggetto" required />

            @include('category.selector', [
                'orientation' => 'horizontal',
                'selected' => $donation ? $donation->category_id : null,
                'type' => 'object',
                'direct_response' => false
            ])

            <x-larastrap::textarea name="description" label="Descrizione" required />
            <x-larastrap::text name="size_height" label="Altezza" />
            <x-larastrap::text name="size_width" label="Larghezza" />
            <x-larastrap::text name="size_deep" label="Profondità" />
            <x-larastrap::date name="since" label="Disponibile da" :value="date('Y-m-d')" />

            <br><br><br>

            <?php $last = $donation ? $donation : $currentuser->lastDonation() ?>

            <x-larastrap::enclose :obj="$last">
                <x-larastrap::text name="name" label="Nome" required />
                <x-larastrap::text name="surname" label="Cognome" required />

                @if(App\Config::getConf('explicit_zones') == 'true')
                    @include('donation.areaselect', [
                        'label' => 'Zona',
                        'selected' => $donation ? $donation->area : null,
                        'field_name' => 'area',
                    ])
                @endif

                <x-larastrap::text name="address" label="Indirizzo (via, numero civico, CAP, città)" required />
                <x-larastrap::text name="phone" label="Telefono" required />
                <x-larastrap::email name="email" label="E-Mail" required />
                <x-larastrap::text name="floor" label="Piano" />

                <x-larastrap::check inline name="elevator" label="C'è l'ascensore" />
            </x-larastrap::enclose>

            <x-larastrap::textarea name="shipping_notes" label="Note" />
            <x-larastrap::check inline name="autoship" label="Lo posso trasportare io" />
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
