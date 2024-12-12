<?php

$calls = App\Call::where('status', 'open')->where('type', $call_type)->where('when', '>=', date('Y-m-d'))->whereHas('category', function($query) {
    $query->where('direct_response', false);
})->get();

?>

@if($calls->count() > 0)
    @php

    $options = [
        '-1' => 'Nessun appello specifico',
    ];

    foreach ($calls as $iter_call) {
        $options[$iter_call->id] = (object) [
            'label_html' => sprintf('%s <a class="show-details" data-endpoint="manca" data-item-id="%s"><br>(dettagli)</a>', $iter_call->title, $iter_call->id),
        ];
    }

    if ($call && isset($options[$call->id]) == false) {
        $options[$call->id] = $call->title;
    }

    @endphp

    <x-larastrap::radiolist name="call_id" label="Seleziona, eventualmente, l'appello a cui stai rispondendo con questa donazione" :options="$options" />

    <p class="mt-3">
        Puoi consultare l'elenco completo degli appelli, con i relativi dettagli, su <a href="{{ route('manca.index') }}">questa pagina</a>.
    </p>
@else
    <x-larastrap::hidden name="call_id" :value="$call ? $call->id : -1" />
@endif
