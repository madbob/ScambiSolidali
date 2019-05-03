<?php $call_query = App\Call::where('status', 'open')->where('type', $call_type)->where('when', '>=', date('Y-m-d')) ?>

@if($call_query->count() > 0)
    <br/>
    <p>Seleziona, eventualmente, l'appello a cui stai rispondendo con questa donazione:</p>

    <div class="radio">
        <div class="radio radio-custom">
            <input id="no_call" type="radio" name="call_id" value="-1" {{ $call == null ? 'checked' : '' }}>
            <label for="no_call">Nessun appello specifico</label>
        </div>
    </div>

    <?php $call_found = false ?>

    @foreach($call_query->get() as $iter_call)
        <?php $call_found = ($call && $call->id == $iter_call->id) ?>
        <div class="radio radio-custom">
            <input id="call_{{ $iter_call->id }}" type="radio" name="call_id" value="{{ $iter_call->id }}" {{ $call && $call->id == $iter_call->id ? 'checked' : '' }}>
            <label for="call_{{ $iter_call->id }}">{{ $iter_call->title }} <a class="show-details" data-endpoint="manca" data-item-id="{{ $iter_call->id }}">(dettagli)</a></label>
        </div>
    @endforeach

    @if(!$call_found && $call)
        <div class="radio radio-custom">
            <input id="call_{{ $call->id }}" type="radio" name="call_id" value="{{ $call->id }}" checked>
            <label for="call_{{ $call->id }}">{{ $call->title }} <a class="show-details" data-endpoint="manca" data-item-id="{{ $call->id }}">(dettagli)</a></label>
        </div>
    @endif

    <p>
        Puoi consultare l'elenco completo degli appelli, con i relativi dettagli, su <a href="{{ url('manca') }}">questa pagina</a>.
    </p>

    <br/>
    <br/>
    <br/>
@else
    <input type="hidden" name="call_id" value="{{ $call ? $call->id : -1 }}">
@endif
